<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $amount = $this->command->getOutput()->ask("How many users do you want?", 150);

        $password = $this->command->getOutput()->ask("Which password do you want?", "1234567");

        //progressStart(500) ovde mu govorimo kada budemo imali onu liniju on ce je popunjavati od 0 do 500
        //$this->command->getOutput() progress barovi se baziraju na tim nekim komandama (naucicu nekad)
        $this->command->getOutput()->progressStart($amount);

        //prvo pravimo faker sa Factory[faker]  use Faker\Factory; 
        //u create(); mu mozemo reci na kom jeziku da pravi podatke
        $faker = Factory::create();
        for( $i = 0; $i < $amount; $i++ ) { 
            User::create([
                "name" => $faker->name,
                "email"=> $faker->unique()->safeEmail(),
                "password"=> Hash::make($password),
                "role" => $faker->randomElement(["admin", "user"])
            ]);

            //govorimo mu da ga povecava za 1 (dakle on sad kad upise jednog korisnika sitice dovde i povecace za 1)
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
