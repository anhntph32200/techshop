<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
       'order_id',
       'productvariant_id',
       'quantity',
       'listed_price',
       'sale_price',
       'import_price',
       'name',
       'image',

    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'productvariant_id'); 
    }

}
