<?php

namespace App\Http\Controllers\Api;

use App\Models\CarMake;
use App\Models\FuelType;
use App\Models\BodyType;
use App\Models\Car;
use App\Models\Transmission;
use App\Models\Feature;

class MetaController
{
   public function filters()
   {
      return response()->json([

         'makes' => CarMake::select('id', 'name')
            ->orderBy('name')
            ->get(),

         'fuel_types' => FuelType::select('id', 'name')->get(),

         'body_types' => BodyType::select('id', 'name')->get(),

         'transmissions' => Transmission::select('id', 'name')->get(),

         'features' => Feature::select('id', 'name')->get(),

         'user' => Car::select('user_id')->get()
      ]);
   }
}