<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $fillable = ['name', 'image', 'status', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
  
    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id'); 
    }

}
