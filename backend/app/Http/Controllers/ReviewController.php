<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('admin.pages.reviews.index', compact('reviews'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Lấy danh sách review của sản phẩm
        $reviews = Review::where('product_id', $id)->where('status', 'visible')->get();
        // Tính toán số lượng đánh giá cho mỗi sao
        $ratingHistogram = [];
        foreach (range(1, 5) as $i) {
            $ratingHistogram[$i] = $reviews->where('rating', $i)->count();
        }

        // Tính điểm trung bình rating
        $averageRating = $reviews->avg('rating') ?: 0;

        return view('product_detail', compact('reviews', 'product', 'averageRating', 'ratingHistogram'));
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('reviews.create', compact('product'));
    }

    public function store(Request $request, $product_id)
    {
        // Kiểm tra xem người dùng có đăng nhập chưa
        if (auth()->guest()) {
            return redirect()->route('login');
        }

        $user = auth()->user(); // Lấy thông tin người dùng

        // Kiểm tra nếu người dùng đã mua sản phẩm
        $hasPurchased = Order::where('user_id', Auth::id())
            ->whereHas('orderDetails', function ($query) use ($product_id) {
                $query->whereHas('productVariant', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);  // So sánh product_id của productvariant
                });
            })
            ->exists();
        if (!$hasPurchased) {
            return redirect()->back()->withErrors(['error' => 'Bạn phải mua sản phẩm này trước khi đánh giá.']);
        }


        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        // Tạo mới bình luận và đánh giá
        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->withErrors('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }


    public function destroy(Review $review)
    {
        // Kiểm tra quyền xóa bình luận (chỉ admin hoặc chính người tạo có thể xóa)
        if ($review->user_id !== auth()->id() && !auth()->user()->is_admin) {
            return redirect()->back()->withErrors('error', 'Bạn không có quyền xóa bình luận này');
        }

        $review->delete();
        return redirect()->back()->withErrors('success', 'Bình luận đã được xóa');
    }

    public function toggleVisibility($id)
    {
        $review = Review::findOrFail($id);
        $review->status = $review->status === 'visible' ? 'hidden' : 'visible';
        $review->save();

        return back()->with('success', 'Thay đổi trạng thái thành công.');
    }


    public function showComments()
    {
        $reviews = Review::where('status', 'visible')->get();
        return view('reviews.index', compact('reviews'));
    }
}
