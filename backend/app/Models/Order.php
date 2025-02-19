<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const TRANG_THAI_DON_HANG = [
        'cho_xac_nha' => 'Chờ xác nhận',
        'da_xac_nha' => 'Đã xác nhận',
        'dang_chuan_bi' => 'Đang chuẩn bị',
        'dang_van_chuyen' => 'Đang vận chuyển',
        'da_nhan_hang' => 'Đã nhận hàng',
        'huy_hang' => 'Hủy hàng',
    ];

    const TRANG_THAI_THANH_TOAN = [
        'chua_thanh_toan' => 'Chưa thanh toán',
        'da_thanh_toan' => 'Đã thanh toán',
    ];

    const CHO_XAC_NHA = 'cho_xac_nha';
    const DA_XAC_NHA = 'da_xac_nha';
    const DANG_CHUAN_BI = 'dang_chuan_bi';
    const DANG_VAN_CHUYEN = 'dang_van_chuyen';
    const DA_NHAN_HANG = 'da_nhan_hang';
    const HUY_HANG = 'huy_hang';
    const CHUA_THANH_TOAN = 'chua_thanh_toan';
    const DA_THANH_TOAN = 'da_thanh_toan';
    protected $fillable = [
          'code',
          'status',
          'payment_type',
          'payment_status',
          'total_price',
          'user_id',
          'promotion_id',
          'shipping_id',
          'name',
          'address',
          'money_total',
          'phone',
          'note',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderHistories()
    {
        return $this->hasMany(OrderHistory::class);
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}

