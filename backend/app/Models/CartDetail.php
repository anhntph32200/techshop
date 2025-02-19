<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'carts_details';
    protected $fillable = [
        'carts_id',
        'product_variant_id',

        'quantity',

    ];
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'carts_id');
    }
}