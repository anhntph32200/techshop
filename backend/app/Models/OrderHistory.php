<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    protected $fillable = [
         'order_id',
         'user_id',
         'from_status',
         'to_status',
         'note',
         'datetime',

    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function order()
    {
        return $this->belongsTo(Order::class);

    }
}
