<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class CarService
{
    protected function syncFeatures(Car $car, array $featureIds): void
    {
        $car->features()->sync($featureIds);
    }

    protected function storeImages(Car $car, array $images): void
    {
        $gd = new Driver();
        $manager = new ImageManager($gd);

        foreach ($images as $index => $file) {
            $fileName = uniqid() . ".webp";

            $image = $manager->read($file)->toWebp(90)->toString();

            $path = "cars/{$car->id}/{$fileName}";

            Storage::disk('public')->put($path, $image);

            $car->images()->create([
                'image_path' => $path,
                'is_primary' => $index === 0,
                'sort_order' => $index
            ]);
        }
    }

    public function createListing(array $data, ?array $images = null): Car
    {
        return DB::transaction(
            function () use ($data, $images) {
                $featureIds = $data['features'] ?? [];
                
                unset($data['features']);
                
                $data['user_id'] = auth()->id();

                $data['slug'] = Str::slug($data['title'] . '-' . uniqid());

                $car = Car::create($data);

                if($featureIds) {
                    $this->syncFeatures($car, $featureIds);
                }

                if ($images) {
                    $this->storeImages($car, $images);
                }

                return $car;
            }
        );
    }

    public function updateListing(Car $car, array $data)
    {
        return DB::transaction(
            function() use($car, $data) {
                $featureIds = $data['features'] ?? [];

                if(array_key_exists('features', $data)) {
                    $this->syncFeatures(
                        $car,
                        $featureIds
                    );
                }

                unset($data['features']);

                if(isset($data['title'])) $data['slug'] = Str::slug($data['title'] . '-' . uniqid());
                
                $car->update($data);

                return $car->load([
                    'make',
                    'model',
                    'fuelType',
                    'bodyType',
                    'transmission',
                    'features',
                    'images',
                    'user'
                ]);
            }
        );
    }

    public function deleteListing(Car $car): void
    {
        $folder = "cars/{$car->id}";

        DB::transaction(function() use($car){
            $car->features()->detach();
            $car->images()->delete();
            $car->delete();
        });

        Storage::disk('public')->deleteDirectory($folder);
    }
}