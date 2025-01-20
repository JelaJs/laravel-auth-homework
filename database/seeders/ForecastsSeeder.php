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
            Forecasts::create([
                "city_id" => $city->id,
                "temperature" => $faker->randomFloat(2,-5, 35),
                "date" => $faker->unique()->dateTimeInInterval($startDate = '-1 days', $interval = '+ 5 months', $timezone = null) 
            ]);
        }
    }
}
