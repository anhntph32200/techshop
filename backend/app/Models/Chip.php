<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chip extends Model
{
    use HasFactory;
    protected $table = "chips";

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'chip_id');
    }
}
