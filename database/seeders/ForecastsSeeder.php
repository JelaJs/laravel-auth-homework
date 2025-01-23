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
                $weather_type = $faker->randomElement(['sunny', 'rainy', 'snowy']);
                $probability = $weather_type === 'sunny' ? null : $faker->numberBetween(0, 100);

                Forecasts::create([
                    "city_id" => $city->id,
                    "temperature" => $faker->randomFloat(2,-5, 35),
                    "date" => $faker->unique()->dateTimeInInterval($startDate = '-1 days', $interval = '+ 5 months', $timezone = null),
                    "weather_type" => $weather_type,
                    "probability" => $probability,
                ]);
            }
        }
    }
}
