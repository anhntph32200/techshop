<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Chip;
use App\Models\Ram;
use App\Models\Storage;

use App\Models\User;



class UserController extends Controller
{
    public function index()
    {
        // Truy vấn chung để tránh lặp lại mã
        $commonQuery = function ($categoryName = null) {
            $query = Product::with(['subCategory', 'variants'])
                ->where('is_show_home', 1)
                ->take(12);
    
            if ($categoryName) {
                $query->whereHas('subCategory', function ($subQuery) use ($categoryName) {
                    $subQuery->whereHas('category', function ($catQuery) use ($categoryName) {
                        $catQuery->where('name', 'like', '%' . $categoryName . '%');
                    });
                });
            }
    
            return $query;
        };
    
        // Sắp xếp sản phẩm theo rating trung bình từ cao đến thấp
        $highRatedProducts = Product::with(['subCategory', 'variants', 'reviews'])
            ->where('is_show_home', 1)
            ->get()
            ->sortByDesc(function ($product) {
                return $product->reviews->avg('rating');
            })
            ->take(12); 
    
        $latestProducts = $commonQuery()->latest('created_at')->get();
        $viewProducts = $commonQuery()->orderBy('view', 'desc')->get();
        $hotProducts = $commonQuery()->where('is_hot', 1)->latest('created_at')->get();
        $saleProducts = $commonQuery()->where('is_sale', 1)->latest('created_at')->get();
        $randomProducts = $commonQuery()->inRandomOrder()->take(5)->get();
    
        // Sản phẩm theo danh mục
        $laptopProducts = $commonQuery('laptop')->latest('created_at')->get();
        $banphimProducts = $commonQuery('bàn phím')->latest('created_at')->get();
        $chuotProducts = $commonQuery('chuột')->latest('created_at')->get();
        $loaProducts = $commonQuery('loa')->latest('created_at')->get();
        $taingheProducts = $commonQuery('tai nghe')->latest('created_at')->get();
    
        return view('user.pages.home', compact(
            'latestProducts', 'hotProducts', 'saleProducts', 'randomProducts', 'highRatedProducts',
            'laptopProducts', 'banphimProducts', 'chuotProducts', 'loaProducts', 'taingheProducts', 'viewProducts'
        ));
    }

    public function showSubCategories(SubCategory $subCategory)
    {
        if ($subCategory) {
            $products = Product::with(['subCategory', 'variants'])
                ->where('sub_category_id', $subCategory->id)
                ->where('is_show_home', 1)
                ->paginate(20);
        } else {
            $products = Product::with(['subCategory', 'variants'])->paginate(20);
        }


        $latestProducts = Product::with(['subCategory', 'variants'])
            ->where('is_show_home', 1)
            ->latest('created_at')
            ->take(12)
            ->get();

        // Lấy dữ liệu cần thiết cho bộ lọc
        $categories = Category::with('subCategories')->get();

        $sub_category = SubCategory::pluck('name', 'id')->all();
        $chips = Chip::pluck('name', 'id')->all();
        $rams = Ram::pluck('name', 'id')->all();
        $storages = Storage::pluck('name', 'id')->all();

        // Trả về view với tất cả dữ liệu cần thiết

        return view('user.pages.product_category', compact('products', 'subCategory', 'sub_category', 'chips', 'rams', 'storages', 'latestProducts'));

    }

    public function filter(Request $request)
    {
        $query = Product::with(['subCategory', 'variants']);
        $isFiltered = false;

        // Lọc theo tên sản phẩm
        if ($request->has('name') && !empty($request->input('name'))) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->input('name')) . '%']);
            $isFiltered = true;
        }

        // Lọc theo danh mục con
        if ($request->filled('sub_category_id')) {

            $query->where('is_show_home', 1)->where('sub_category_id', $request->input('sub_category_id'));

            $isFiltered = true;
        }

        // Lọc theo khoảng giá dựa trên lựa chọn từ checkbox
        $priceRange = $request->input('price_range');
        if ($priceRange) {
            $isFiltered = true;
            $query->whereHas('variants', function ($q) use ($priceRange) {
                switch ($priceRange) {
                    case 'below_10':
                        $q->where('sale_price', '<', 10000000)
                        ->orWhere('listed_price', '<', 10000000);
                        break;
                    case '10_15':
                        $q->whereBetween('sale_price', [10000000, 15000000])
                        ->orWhereBetween('listed_price', [10000000, 15000000]);
                        break;
                    case '15_20':
                        $q->whereBetween('sale_price', [15000000, 20000000])
                        ->orWhereBetween('listed_price', [15000000, 20000000]);
                        break;
                    case '20_30':
                        $q->whereBetween('sale_price', [20000000, 30000000])
                        ->orWhereBetween('listed_price', [20000000, 30000000]);
                        break;
                    case 'above_30':
                        $q->where('sale_price', '>', 30000000)
                        ->orWhere('listed_price', '>', 30000000);
                        break;
                }
            });
        }

        // Lọc theo chip
        if ($request->has('chip_id') && !empty($request->input('chip_id'))) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('chip_id', $request->input('chip_id'));
            });
            $isFiltered = true;
        }

        // Lọc theo RAM
        if ($request->has('ram_id') && !empty($request->input('ram_id'))) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('ram_id', $request->input('ram_id'));
            });
            $isFiltered = true;
        }

        // Lọc theo dung lượng lưu trữ
        if ($request->has('storage_id') && !empty($request->input('storage_id'))) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('storage_id', $request->input('storage_id'));
            });
            $isFiltered = true;
        }

        // Nếu không có lọc, lấy tất cả sản phẩm
        $products = $isFiltered 
        ? $query->where('is_show_home', 1)->orderBy('created_at', 'desc')->paginate(20) 
        : Product::with(['subCategory', 'variants'])
                 ->where('name', 'like', '%laptop%')
                 ->where('is_show_home', 1)
                 ->orderBy('created_at', 'desc')  // Thêm orderBy ở đây
                 ->paginate(20);
    
        $latestProducts = Product::with(['subCategory', 'variants'])
            ->where('is_show_home', 1)
            ->latest('created_at')
            ->take(12)
            ->get();
        // Lấy các thông tin khác (danh mục con, chip, RAM, dung lượng lưu trữ)
        $categories = Category::with('subCategories')->get();
        $chips = Chip::pluck('name', 'id')->all();
        $rams = Ram::pluck('name', 'id')->all();
        $storages = Storage::pluck('name', 'id')->all();
        $sub_category = SubCategory::pluck('name', 'id')->all();


        return view('user.pages.product_category', compact('sub_category', 'products', 'categories', 'chips', 'rams', 'storages', 'latestProducts'));

    }

    public function show($id)
    {
        $product = Product::with(['variants', 'subCategory', 'productImages'])->findOrFail($id);

        $product->increment('view');

        $categories = Category::with('subCategories')->get();

        $relatedProducts = Product::where('sub_category_id', $product->sub_category_id)
            ->where('id', '!=', $id)
            ->take(16) 
            ->get();

        return view('user.pages.product_detail', compact('product', 'relatedProducts'));
    }

    public function getUserName($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('user.partials.menu', ['userName' => $user->name]);

    }

}
