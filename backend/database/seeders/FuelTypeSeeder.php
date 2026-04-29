<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Petrol',
            'Diesel',
            'Hybrid',
            'Electric',
            'LPG',
            'CNG'
        ];

        foreach($items as $name){

            FuelType::firstOrCreate([
                'name'=>$name
            ]);

        }
    }
}
