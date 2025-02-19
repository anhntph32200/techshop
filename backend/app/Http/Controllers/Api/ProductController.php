<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // API lấy danh sách sản phẩm
    public function index()
    {
        $products = Product::with(['subCategory', 'variants', 'productImages'])
            ->where('is_show_home', true)
            ->get();
        return response()->json($products, 200);
    }

    // API lấy danh sách sản phẩm hot
    public function hotProducts()
    {
        $hotProducts = Product::with(['subCategory', 'variants', 'productImages'])
            ->where('is_hot', true)
            ->get();
        return response()->json($hotProducts, 200);
    }

    // API lấy danh sách sản phẩm đang sale
    public function saleProducts()
    {
        $saleProducts = Product::with(['subCategory', 'variants', 'productImages'])
            ->where('is_sale', true)
            ->get();
        return response()->json($saleProducts, 200);
    }

    // API chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::with(['subCategory', 'variants', 'productImages'])->findOrFail($id);
        return response()->json($product, 200);
    }

    // API lọc sản phẩm
    public function filter(Request $request)
    {
        $query = Product::with(['subCategory', 'variants', 'productImages']);

        // Lọc theo danh mục con
        if ($request->has('sub_category_id')) {
            $query->where('sub_category_id', $request->input('sub_category_id'));
        }

        // Lọc theo giá
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->whereBetween('sale_price', [$request->input('min_price'), $request->input('max_price')])
                      ->orWhereBetween('listed_price', [$request->input('min_price'), $request->input('max_price')]);
                });
            });
        }

        // Lọc theo chip
        if ($request->has('chip_id')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('chip_id', $request->input('chip_id'));
            });
        }

        // Lọc theo RAM
        if ($request->has('ram_id')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('ram_id', $request->input('ram_id'));
            });
        }

        // Lọc theo dung lượng lưu trữ
        if ($request->has('storage_id')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('storage_id', $request->input('storage_id'));
            });
        }

        $products = $query->get();
        return response()->json($products, 200);
    }
}
