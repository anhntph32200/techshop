<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Chip;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\SubCategory;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Khởi tạo query
        $query = Product::query()->with(['subCategory', 'variants']);

        // Lọc theo giá
        if ($request->has('price_range') && $request->price_range !== null) {
            switch ($request->price_range) {
                case 'under_1m':
                    $query->whereHas('variants', function ($variantQuery) {
                        $variantQuery->where('sale_price', '<', 1000000);
                    });
                    break;
                case '1m_5m':
                    $query->whereHas('variants', function ($variantQuery) {
                        $variantQuery->whereBetween('sale_price', [1000000, 5000000]);
                    });
                    break;
                case '5m_15m':
                    $query->whereHas('variants', function ($variantQuery) {
                        $variantQuery->whereBetween('sale_price', [5000000, 15000000]);
                    });
                    break;
                case '15m_25m':
                    $query->whereHas('variants', function ($variantQuery) {
                        $variantQuery->whereBetween('sale_price', [15000000, 25000000]);
                    });
                    break;
                case 'above_25m':
                    $query->whereHas('variants', function ($variantQuery) {
                        $variantQuery->where('sale_price', '>', 25000000);
                    });
                    break;
            }
        }
        // Lọc theo danh mục con
        if ($request->has('sub_category_id') && $request->sub_category_id) {
            $query->where('sub_category_id', $request->sub_category_id);
        }

        // Lọc theo chip
        if ($request->has('chip_id') && $request->chip_id) {
            $query->whereHas('variants', function ($variantQuery) use ($request) {
                $variantQuery->where('chip_id', $request->chip_id);
            });
        }

        // Lọc theo RAM
        if ($request->has('ram_id') && $request->ram_id) {
            $query->whereHas('variants', function ($variantQuery) use ($request) {
                $variantQuery->where('ram_id', $request->ram_id);
            });
        }

        // Lọc theo bộ nhớ (Storage)
        if ($request->has('storage_id') && $request->storage_id) {
            $query->whereHas('variants', function ($variantQuery) use ($request) {
                $variantQuery->where('storage_id', $request->storage_id);
            });
        }

        // Lọc theo trạng thái (is_hot, is_sale, is_show_home)
        if ($request->has('is_hot') && $request->is_hot !== null) {
            $query->where('is_hot', $request->is_hot);
        }
        if ($request->has('is_sale') && $request->is_sale !== null) {
            $query->where('is_sale', $request->is_sale);
        }
        if ($request->has('is_show_home') && $request->is_show_home !== null) {
            $query->where('is_show_home', $request->is_show_home);
        }

        // Phân trang
        $data = $query->latest('id')->paginate(6);

        // Truyền thêm dữ liệu cho bộ lọc
        $subCategories = SubCategory::pluck('name', 'id')->all();
        $chips = Chip::pluck('name', 'id')->all();
        $rams = Ram::pluck('name', 'id')->all();
        $storages = Storage::pluck('name', 'id')->all();

        return view('admin.pages.products.list', compact('data', 'subCategories', 'chips', 'rams', 'storages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sub_category = Subcategory::query()->pluck('name', 'id')->all();
        $chips = Chip::query()->pluck('name', 'id')->all();
        $rams = Ram::query()->pluck('name', 'id')->all();
        $storages = Storage::query()->pluck('name', 'id')->all();

        return view('admin.pages.products.create', compact('sub_category', 'chips', 'rams', 'storages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        try {
            // Tạo sản phẩm mới
            $product = Product::create([
                'sub_category_id' => $request->sub_category_id,
                'name' => $request->name,
                'description' => $request->description,
                'content' => $request->input('content'),
                'view' => 0,
                'is_hot' => $request->is_hot,
                'is_sale' => $request->is_sale,
                'is_show_home' => $request->is_show_home,
            ]);

            // Xử lý ảnh đại diện
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('product', 'public');
                $product->update(['image' => $imagePath]);
            }

            // Xử lý ảnh phụ
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $imagePath = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $imagePath,
                        'alt_text' => 'Hình ảnh sản phẩm ' . ($index + 1),
                    ]);
                }
            }

            // Xử lý biến thể sản phẩm
            foreach ($request->chip_id as $index => $chipId) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'chip_id' => $chipId,
                    'ram_id' => $request->ram_id[$index],
                    'storage_id' => $request->storage_id[$index],
                    'listed_price' => $request->listed_price[$index],
                    'sale_price' => $request->sale_price[$index],
                    'quantity' => $request->quantity[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('admins.products.index')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Đã có lỗi xảy ra!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('productImages')->find($id); // Lấy sản phẩm cùng với hình ảnh

        if (!$product) {
            return redirect()->route('admins.products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        return view('admin.pages.products.detail', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $product = Product::with(['productImages', 'variants'])->findOrFail($id);

        $sub_categories = Subcategory::pluck('name', 'id')->all();
        $chips = Chip::pluck('name', 'id')->all();
        $rams = Ram::pluck('name', 'id')->all();
        $storages = Storage::pluck('name', 'id')->all();

        return view('admin.pages.products.edit', compact('product', 'sub_categories', 'rams', 'storages', 'chips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);
            $product->update($request->validated());

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('product', 'public');
                $product->update(['image' => $imagePath]);
            }

            if ($request->hasFile('images')) {
                ProductImage::where('product_id', $product->id)->delete();
                foreach ($request->file('images') as $index => $image) {
                    $imagePath = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $imagePath,
                        'alt_text' => 'Hình ảnh sản phẩm ' . ($index + 1),
                    ]);
                }
            }

            // Lấy danh sách các variant hiện tại
            $currentVariants = ProductVariant::where('product_id', $product->id)->get();

            // Duyệt qua các biến thể gửi từ request
            foreach ($request->chip_id as $index => $chipId) {
                $variantData = [
                    'product_id' => $product->id,
                    'chip_id' => $chipId,
                    'ram_id' => $request->ram_id[$index],
                    'storage_id' => $request->storage_id[$index],
                    'listed_price' => $request->listed_price[$index],
                    'sale_price' => $request->sale_price[$index],
                    'quantity' => $request->quantity[$index],
                ];

                if (isset($currentVariants[$index])) {
                    // Cập nhật bản ghi nếu tồn tại
                    $currentVariants[$index]->update($variantData);
                } else {
                    // Tạo mới nếu không tồn tại
                    ProductVariant::create($variantData);
                }
            }

            // Xóa các bản ghi dư thừa
            if (count($currentVariants) > count($request->chip_id)) {
                $excessVariants = $currentVariants->slice(count($request->chip_id));
                foreach ($excessVariants as $variant) {
                    // Kiểm tra nếu không có dữ liệu liên quan trước khi xóa
                    if ($variant->cartsDetails()->exists()) {
                        throw new \Exception('Không thể xóa biến thể vì đang được tham chiếu.');
                    }
                    $variant->delete();
                }
            }

            DB::commit();
            return redirect()->route('admins.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            // Kiểm tra nếu sản phẩm có liên quan đến đơn hàng chưa thanh toán
            $orderRelated = $product->orderDetails()->whereHas('order', function ($query) {
                $query->where('payment_status', 'chua_thanh_toan'); // Trạng thái thanh toán chưa thanh toán
            })->exists();

            // Kiểm tra nếu sản phẩm có liên quan đến giỏ hàng chưa thanh toán
            $cartRelated = $product->cartDetails()->whereHas('cart', function ($query) {
                $query->where('status', 'chua_thanh_toan'); // Trạng thái giỏ hàng chưa thanh toán
            })->exists();

            // Nếu sản phẩm có liên quan đến đơn hàng hoặc giỏ hàng chưa thanh toán, không cho phép xóa
            if ($orderRelated || $cartRelated) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Không thể xóa sản phẩm này vì nó đang có trong giỏ hàng hoặc đơn hàng chưa thanh toán!']);
            }

            // Xóa ảnh sản phẩm
            if ($product->image) {
                $imagePath = public_path('storage/' . $product->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Xóa ảnh chi tiết sản phẩm
            $productImages = ProductImage::where('product_id', $product->id)->get();
            foreach ($productImages as $productImage) {
                $imagePath = public_path('storage/' . $productImage->image_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Xóa thông tin chi tiết ảnh và biến thể sản phẩm
            ProductImage::where('product_id', $product->id)->delete();
            ProductVariant::where('product_id', $product->id)->delete();

            // Xóa sản phẩm
            $product->delete();

            DB::commit();
            return redirect()->route('admins.products.index')->with('danger', 'Xóa sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => 'Không thể xóa sản phẩm!']);
        }
    }
}
