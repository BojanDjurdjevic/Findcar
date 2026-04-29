<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'ABS' => 'safety',
            'ESP' => 'safety',
            'Air Conditioning' => 'comfort',
            'Navigation' => 'infotainment',
            'Leather Seats' => 'comfort',
            'Parking Sensors' => 'safety',
            'Rear Camera' => 'safety',
            'Cruise Control' => 'comfort',
            'Heated Seats' => 'comfort',
            'Panoramic Roof' => 'comfort',
        ];

        foreach($items as $name => $category){

            Feature::firstOrCreate([
                'name'=>$name,
                'category' => $category
            ]);

        }        
    }
}
