<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'user_id', 'make_id', 'model_id',
        'fuel_type_id', 'body_type_id', 'transmission_id',
        'title', 'year', 'price', 'mileage',
        'engine_size', 'horsepower', 'color',
        'description', 'location', 'slug',
        'featured', 'status', 
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function make(): BelongsTo
    {
        return $this->belongsTo(CarMake::class, 'make_id');
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }

    public function transmission(): BelongsTo
    {
        return $this->belongsTo(Transmission::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(CarImage::class)
                ->where('is_primary', true);
    }

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'price' => 'integer',
            'mileage' => 'integer',
            'horsepower' => 'integer',
            'engine_size' => 'decimal:1',
            'year' => 'integer',
        ];
    }

}
