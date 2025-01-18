<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = $this->command->getOutput()->ask("Write email address"); 

        if(User::where("email", $email)->exists()) {
            $this->command->getOutput()->error("User with this email already exist. Try another one");
            return;
        }

        if($email === null) {
            $this->command->getOutput()->error("Email is required.");
            return;
        }

        $name = $this->command->getOutput()->ask("Choose Name", "Test User");
        $password = $this->command->getOutput()->ask("Choose password", 1234567);

        User::create([
            "name" => $name,
            "email"=> $email,
            "password"=> Hash::make($password),
            "role" => "user"
        ]);
    }
}
