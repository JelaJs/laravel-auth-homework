<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\Weather;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

       $city_id = $this->command->getOutput()->ask("Write the city id"); 

       if(!Cities::where("id", $city_id)->exists()) {
            $this->command->error("City with this id doesn't exist");
            return;
       }
    
       if(Weather::where("city_id", $city_id)->exists()) { 
            $this->command->error("City with this id already exist in Weather table");
            return;
       }

        $temperature = $this->command->getOutput()->ask("Write the temperature"); 
        if(!is_numeric($temperature)) {
            $this->command->error("Temperature must be numeric value");
            return;
       }

       Weather::create([
        "city_id" => $city_id,
        "temperature" => $temperature
       ]); 

       $this->command->info("Weather created");
    }
}
