<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class WishlistItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wishlist_id',  // If wishlist_id is mass assignable, add it here
        'product_id',   // Add product_id here to allow mass assignment
    ];
    /**
     * Define the relationship between WishlistItem and Wishlist.
     */
    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }
    /**
     * Define the relationship between WishlistItem and Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}