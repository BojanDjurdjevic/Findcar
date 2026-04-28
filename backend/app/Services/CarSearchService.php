<?php

namespace App\Services;

use App\Filters\CarFilter;
use App\Models\Car;

class CarSearchService 
{
    public function search(array $fiters)
    {
        $query = Car::query();

        $query = (new CarFilter)->apply($query, $fiters);

        return $query->paginate(15);
    }
}