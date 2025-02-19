<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'discount', 'discount_type', 'minimum_spend', 'start_date', 'end_date', 'usage_limit', 'used_count', 'status'
    ];

    public function isValid()
    {
        $currentDate = now();
        $isValid = $this->start_date <= $currentDate &&
                   $this->end_date > $currentDate &&
                   ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    
        if (!$isValid) {
            Log::warning('Promotion is not valid:', [
                'code' => $this->code,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'usage_limit' => $this->usage_limit,
                'used_count' => $this->used_count,
                'current_date' => $currentDate,
            ]);
        }
    
        return $isValid;
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
