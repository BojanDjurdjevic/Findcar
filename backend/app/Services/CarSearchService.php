<?php

namespace App\Services;

use App\Filters\CarFilter;
use App\Models\Car;

class CarSearchService 
{
    public function search(array $filters)
    {
        $query = Car::query()
        ->with([
            'make',
            'model',
            'fuelType',
            'bodyType',
            'transmission',
            'features',
            'images',
            'user'
        ]);

        $query = (new CarFilter)->apply($query, $filters);

        return $query->paginate(15);
    }
}