<?php

namespace Database\Seeders;

use App\Models\Farm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $farms = [
            ['name' => 'KC Farm', 'province_id'=> 1, 'user_id'=> 1],
            ['name' => 'Chetra Farm', 'province_id'=> 1, 'user_id'=> 1],
            ['name' => 'Dara Farm', 'province_id'=> 2, 'user_id'=> 2],
        ];
        foreach($farms as $farm){
            Farm::create($farm);
        }
    }
}
