<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['first_name' => 'Chetra', 'last_name'=> 'Hong', 'email'=> 'chetra@gmail.com', 'password'=> '12345678'],
            ['first_name' => 'Dara', 'last_name'=> 'Sombat', 'email'=> 'dara@gmail.com', 'password'=> '12345678'],
            ['first_name' => 'Phalla', 'last_name'=> 'Ser', 'email'=> 'phalla@gmail.com', 'password'=> '87654321'],
        ];
        foreach($users as $user){
            User::create($user);
        }
    }
}
