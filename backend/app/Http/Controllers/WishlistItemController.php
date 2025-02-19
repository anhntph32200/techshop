<?php
namespace App\Http\Controllers;
use App\Models\WishlistItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class WishlistItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn vui lòng đăng nhâp để thêm sản phẩm yêu thích');
        }
       
        $items = $user->wishlist ? $user->wishlist->items()->with('product')->get() : [];
    
        return view('user.pages.wishlist', compact('items'));
    }
    
    
    /**
     * thêm vào danh sách yêu thích
     */
    public function addToWishlist(Request $request, $productId)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to login to add products to your wishlist.');
        }
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->route('wishlist.index')->with('error', 'Product not found.');
        }
        $wishlist = $user->wishlist()->firstOrCreate([]);
        $wishlist->items()->firstOrCreate(['product_id' => $productId]);
        return redirect()->route('wishlist.index')->with('success', 'Product added to wishlist.');
    }
    /**
     * Remove a product from the wishlist.
     */
    public function removeFromWishlist($productId)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xóa sản phẩm khỏi danh sách yêu thích.');
        }
        // Tìm item trong danh sách yêu thích của người dùng
        $item = WishlistItem::where('product_id', $productId)
            ->whereHas('wishlist', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->first();
        if (!$item) {
            return redirect()->route('wishlist.index')->with('error', 'Sản phẩm không tìm thấy trong danh sách yêu thích.');
        }
        // Xóa sản phẩm khỏi danh sách yêu thích
        $item->delete();
        return redirect()->route('wishlist.index')->with('success', 'Sản phẩm đã được xóa khỏi danh sách yêu thích.');
    }
}