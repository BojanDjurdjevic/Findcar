<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    protected $fillable = [
        'car_make_id',
        'name'
    ];

    public function make(): BelongsTo
    {
        return $this->belongsTo(CarMake::class);
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
