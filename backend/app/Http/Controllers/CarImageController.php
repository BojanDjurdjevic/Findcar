<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;

use App\Services\CarImageService;

use App\Http\Requests\StoreCarImageRequest;

class CarImageController
extends Controller
{
   public function __construct(
      protected CarImageService
      $imageService
   ){}

   public function store(StoreCarImageRequest $request, Car $car) 
   {
    abort_if(auth()->id() !== $car->user_id, 403);

    $this->imageService->addImages($car, $request->file('images'));

    return response()->json([
        'message' =>
        'Images uploaded'
    ]);
    }
}