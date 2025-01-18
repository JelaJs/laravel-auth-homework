<?php

namespace Database\Seeders;

use App\Models\Cities;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $faker = Factory::create();

       $city = $this->command->getOutput()->ask("Write the city you want"); 

       if(Cities::where("name", $city)->exists()) {
            $this->command->getOutput()->error("This city is taken! Try another one.");
            return;
       }

       if($city === null) {
            $this->command->error("You must put city");
            return;
       }

        $temperature = $this->command->getOutput()->ask("Write the temperature"); 
        if(!is_numeric($temperature)) {
            $this->command->error("Temperature must be numeric value");
            return;
       }

       Cities::create([
        "name" => $city,
        "temperature" => $temperature
       ]); 

       $this->command->info("City created");
    }
}
