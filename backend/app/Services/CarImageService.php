<?php

namespace App\Services;

use App\Models\Car;
use App\Models\CarImage;

use DB;

use App\Traits\HandlesImageUpload;
use Illuminate\Support\Facades\DB as FacadesDB;

class CarImageService
{
   use HandlesImageUpload;

   public function addImages(Car $car, array $files): void
   {
      FacadesDB::transaction(
        function() use($car,$files){

           $maxOrder = $car->images()->max('sort_order') ?? -1;

           $hasPrimary = $car->images()->where('is_primary', true)->exists();

           foreach($files as $index => $file){

              $path =
                 $this->storeProcessedImage(
                    $file,
                    "cars/{$car->id}"
                 );

              $car->images()->create([

                  'image_path' => $path,

                  'is_primary' =>
                     !$hasPrimary
                     && $index === 0,

                  'sort_order' =>
                     $maxOrder + 1 + $index
              ]);
           }

        }
      );
   }
}