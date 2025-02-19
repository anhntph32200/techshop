<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    use HasFactory;
    protected $table = "rams";

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'ram_id');
    }
}

