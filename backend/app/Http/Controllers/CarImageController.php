<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;

use App\Services\CarImageService;

use App\Http\Requests\StoreCarImageRequest;
use Illuminate\Support\Facades\Gate;

class CarImageController
extends Controller
{
   public function __construct(
      protected CarImageService
      $imageService
   ){}

   public function store(StoreCarImageRequest $request, Car $car) 
    {
        Gate::authorize('create', Car::class);

        $this->imageService->addImages($car, $request->file('images'));

        return response()->json([
            'message' =>
            'Images uploaded'
        ]);
    }

    public function destroy(Car $car, CarImage $image)
    {
        Gate::authorize('delete', Car::class);

        $this->imageService->deleteImage($car, $image);

        return response()->json([
            'message' =>
            'Image is successfully deleted.'
        ]);
    }
}