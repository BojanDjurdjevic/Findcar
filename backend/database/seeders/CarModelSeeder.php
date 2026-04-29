<?php

namespace Database\Seeders;

use App\Models\CarMake;
use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    public function run(): void
    {
        $models = [

        'Alfa Romeo'=> [
            '147','156','159',
            'Giulietta',
            'Giulia',
            'Brera',
            'Stelvio',
            'MiTo',
            'GT',
            'Spider'
            ],

            'Toyota'=> [
                'Yaris',
                'Corolla',
                'Avensis',
                'Camry',
                'Prius',
                'RAV4',
                'Land Cruiser',
                'C-HR',
                'Hilux',
                'Auris'
            ],

            'Honda'=> [
                'Civic',
                'Accord',
                'CR-V',
                'HR-V',
                'Jazz',
                'Prelude',
                'S2000',
                'Legend',
                'Insight',
                'Pilot'
            ],

            'BMW'=> [
                '116',
                '320',
                '520',
                '730',
                'X1',
                'X3',
                'X5',
                'X6',
                'M3',
                'Z4'
            ],

            'Volkswagen' => [
                'Golf',
                'Passat',
                'Tiguan'
            ],

            'Audi' => [
                'A4',
                'A6',
                'Q5'
            ],

            'Mercedes-Benz' => [
                'C200',
                'E220',
                'GLC'
            ],

            'Opel' => [
                'Astra',
                'Insignia',
                'Corsa'
            ],

            'Ford' => [
                'Focus',
                'Mondeo',
                'Kuga'
            ],

            'Renault' => [
                'Clio',
                'Megane',
                'Kadjar'
            ],

            'Peugeot' => [
                '208',
                '308',
                '3008'
            ],

            'Citroen' => [
                'C3',
                'C4',
                'C5'
            ],

            'Fiat' => [
                '500',
                'Punto',
                'Tipo'
            ],

            'Nissan' => [
                'Micra',
                'Qashqai',
                'X-Trail'
            ],

            'Mazda' => [
                'Mazda 3',
                'Mazda 6',
                'CX-5'
            ],

            'Mitsubishi' => [
                'Lancer',
                'Outlander',
                'ASX'
            ],

            'Hyundai' => [
                'i30',
                'Tucson',
                'Santa Fe'
            ],

            'Kia' => [
                'Ceed',
                'Sportage',
                'Sorento'
            ],

            'Suzuki' => [
                'Swift',
                'Vitara',
                'SX4'
            ],

            'Subaru' => [
                'Impreza',
                'Forester',
                'Outback'
            ],

            'Volvo' => [
                'S60',
                'V60',
                'XC60'
            ],

            'Skoda' => [
                'Fabia',
                'Octavia',
                'Superb'
            ],

            'Seat' => [
                'Ibiza',
                'Leon',
                'Ateca'
            ],

            'Jeep' => [
                'Compass',
                'Cherokee',
                'Wrangler'
            ],

            'Land Rover' => [
                'Discovery',
                'Range Rover',
                'Defender'
            ],

            'Porsche' => [
                'Cayenne',
                'Macan',
                'Panamera'
            ],

            'Tesla' => [
                'Model 3',
                'Model S',
                'Model Y'
            ],

            'Mini' => [
                'Cooper',
                'Countryman',
                'Clubman'
            ],

            'Dacia' => [
                'Sandero',
                'Duster',
                'Logan'
            ],

            'Chevrolet' => [
                'Cruze',
                'Captiva',
                'Aveo'
            ],

        ];

        foreach($models as $makeName => $makeModels)
        {

            $make = CarMake::where('name', $makeName)->first();

            foreach($makeModels as $model)
            {

                CarModel::firstOrCreate([

                    'make_id'=>$make->id,

                    'name'=>$model

                ]);

            }

        }
    }
}
