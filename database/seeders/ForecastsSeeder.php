<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\Forecasts;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForecastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = Cities::all();
        $faker = Factory::create();

        foreach($cities as $city) {

            for($i = 0; $i < 5; $i++) {
                $weather_type = $faker->randomElement(['sunny', 'rainy', 'snowy', "cloudy"]);
                $probability = $weather_type === 'sunny' ? null : $faker->numberBetween(0, 100);

                $temperature_ranges = [
                    'sunny' => [-10, 40],
                    'cloudy' => [-10, 15],
                    'rainy' => [-10, 35],
                    'snowy' => [-10, 1]
                ];

                if($i === 0) {  
                    [$min, $max] = $temperature_ranges[$weather_type];
                    $temperature = $faker->randomFloat(1, $min, $max);
                } 
                else {
                    $temperature = $temperature + $faker->randomFloat(1, -5, 5);
                    $temperature = round($temperature, 1);

                    foreach($temperature_ranges as $type => [$min, $max]) {
                        if($temperature >= $min && $temperature <= $max) {
                            $weather_type = $type;
                        }
                    }
                }
               
                Forecasts::create([
                    "city_id" => $city->id,
                    "temperature" => $temperature,
                    "date" => $faker->unique()->dateTimeInInterval($startDate = '-1 days', $interval = '+ 5 months', $timezone = null),
                    "weather_type" => $weather_type,
                    "probability" => $probability,
                ]);
            }
        }
    }
}
