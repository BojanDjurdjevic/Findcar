<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarImage extends Model
{
    protected $fillable = [
        'car_id',
        'image_path',
        'is_primary', 
        'sort_order'
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    protected function casts(): array
    {
    return [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];
    }
}
