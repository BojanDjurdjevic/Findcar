<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarService
{
    protected function syncFeatures(Car $car, array $featureIds): void
    {
        $car->features()->sync($featureIds);
    }

    protected function storeImages(Car $car, array $images): void
    {
        foreach ($images as $index => $file) {
            $path = $file->store('cars', 'public');

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
                
                $data['user_id'] = auth()->id;

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
}