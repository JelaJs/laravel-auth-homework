<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\Weather;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       $cities = Cities::all();

       foreach ($cities as $city) { 
          Weather::create([
               
               "city_id" => $city->id,
               "temperature" => rand(-5, 25)
          ]); 

       }

       $this->command->info("Weather created");
    }
}
