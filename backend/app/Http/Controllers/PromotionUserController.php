<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionUserController extends Controller
{
    public function index()
    {
        // Lấy tất cả khuyến mãi và phân trang
        $promotions = Promotion::where('status', 1)->where('usage_limit', '>', 0)->paginate(10);
        return view('user.pages.promotions', compact('promotions'));
    }
}
