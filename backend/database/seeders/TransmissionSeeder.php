<?php

namespace Database\Seeders;

use App\Models\Transmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransmissionSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Manual',
            'Automatic',
            'CVT'
        ];

        foreach($items as $name){

            Transmission::firstOrCreate([
                'name'=>$name
            ]);

        }
    }
}
