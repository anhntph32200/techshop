<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Wishlist extends Model
{
    /**
     * Define the relationship between Wishlist and WishlistItem.
     */
    public function items()
    {
        return $this->hasMany(WishlistItem::class);  // A wishlist has many items
    }
}