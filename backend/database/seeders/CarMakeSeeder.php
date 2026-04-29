<?php

namespace Database\Seeders;

use App\Models\CarMake;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarMakeSeeder extends Seeder
{
    public function run(): void
    {
        $makes = [
            'Volkswagen',
            'BMW',
            'Audi',
            'Mercedes-Benz',
            'Opel',
            'Ford',
            'Renault',
            'Peugeot',
            'Citroen',
            'Fiat',

            'Alfa Romeo',
            'Toyota',
            'Honda',
            'Nissan',
            'Mazda',
            'Mitsubishi',

            'Hyundai',
            'Kia',
            'Suzuki',
            'Subaru',

            'Volvo',
            'Skoda',
            'Seat',

            'Jeep',
            'Land Rover',
            'Porsche',

            'Tesla',
            'Mini',
            'Dacia',
            'Chevrolet'
        ];

        foreach($makes as $make){

            CarMake::firstOrCreate([
                'name'=>$make
            ]);

        }
    }
}
