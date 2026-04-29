<?php

namespace Database\Seeders;

use App\Models\BodyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Sedan',
            'Hatchback',
            'SUV',
            'Coupe',
            'Wagon',
            'Van',
            'Pickup'
        ];

        foreach($items as $name){

            BodyType::firstOrCreate([
                'name'=>$name
            ]);

        }
    }
}
