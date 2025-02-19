<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'listed_price',
        'sale_price',
        'import_price',
        'quantity',
        'chip_id',
        'ram_id',
       'storage_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function chip()
    {
        return $this->belongsTo(Chip::class, 'chip_id');
    }

    public function ram()
    {
        return $this->belongsTo(Ram::class, 'ram_id');
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'productvariant_id', 'id');
    }

}
