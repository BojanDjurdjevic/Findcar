<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use App\Models\Feature;

use App\Models\CarMake;
use App\Models\FuelType;
use App\Models\BodyType;
use App\Models\Transmission;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        $make =
            CarMake::inRandomOrder()
                ->first();

        $model =
            $make->models()
                 ->inRandomOrder()
                 ->first();

        return [

            'user_id' =>
                User::inRandomOrder()
                    ->first()->id,

            'make_id' =>
                $make->id,

            'model_id' =>
                $model->id,

            'fuel_type_id' =>
                FuelType::inRandomOrder()
                    ->first()->id,

            'body_type_id' =>
                BodyType::inRandomOrder()
                    ->first()->id,

            'transmission_id' =>
                Transmission::inRandomOrder()
                    ->first()->id,

            'title' =>
                $make->name.' '.$model->name,

            'year' =>
                fake()->numberBetween(
                    2008,
                    2024
                ),

            'price' =>
                fake()->numberBetween(
                    4000,
                    40000
                ),

            'mileage' =>
                fake()->numberBetween(
                    25000,
                    220000
                ),

            'engine_size' =>
                fake()->randomFloat(
                    1,
                    1.0,
                    3.5
                ),

            'horsepower' =>
                fake()->numberBetween(
                    75,
                    350
                ),

            'color'=>
                fake()->randomElement([
                    'Black',
                    'White',
                    'Silver',
                    'Blue'
                ]),

            'description'=>
                fake()->paragraph(),

            'location'=>
                fake()->city(),

            'slug'=>
                fake()->slug(),

            'featured'=>
                fake()->boolean(),

            'status'=>'active'
        ];
    }


    public function configure()
    {
        return $this->afterCreating(
            function($car){

                $featureIds =
                    Feature::inRandomOrder()
                      ->limit(rand(3,7))
                      ->pluck('id');

                $car->features()
                    ->sync(
                        $featureIds
                    );


                for($i=0;$i<3;$i++){

                    $car->images()->create([

                        'image_path'=>
                        "cars/{$car->id}/demo{$i}.webp",

                        'is_primary'=>
                            $i===0,

                        'sort_order'=>$i

                    ]);

                }

            }
        );
    }

}