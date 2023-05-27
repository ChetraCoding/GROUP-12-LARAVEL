<?php

namespace Database\Seeders;

use App\Models\Drone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DroneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drones = [
            ['code' => 'D23', 'battery'=> 100, 'payload'=> 'camera', 'lat'=> 30.568762, 'lng'=> 88.439531, 'user_id'=> 1],
            ['code' => 'D24', 'battery'=> 60, 'payload'=> 'ប៉ពង់បាញ់', 'lat'=> 30.568762, 'lng'=> -100.439531, 'user_id'=> 1],
            ['code' => 'D25', 'battery'=> 100, 'payload'=> 'ប៉ពង់បាញ់', 'lat'=> 30.568762, 'lng'=> 88.439531, 'user_id'=> 1],
            ['code' => 'Z20', 'battery'=> 88, 'payload'=> 'camera', 'lat'=> 50.568762, 'lng'=> -68.439531, 'user_id'=> 2],
            ['code' => 'Z30', 'battery'=> 90, 'payload'=> 'ប៉ពង់បាញ់', 'lat'=> 50.568762, 'lng'=> 78.439531, 'user_id'=> 2],
            ['code' => 'Z40', 'battery'=> 100, 'payload'=> 'ប៉ពង់បាញ់', 'lat'=> 22.568762, 'lng'=> -78.439531, 'user_id'=> 2],
        ];
        foreach($drones as $drone){
            Drone::create($drone);
        }
    }
}