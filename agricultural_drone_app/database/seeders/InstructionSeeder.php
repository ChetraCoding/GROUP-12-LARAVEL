<?php

namespace Database\Seeders;

use App\Models\Instruction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructions = [
            ['run_mode' => 'start', 'speed'=> 60, 'lat'=> 30.568762, 'lng'=> 88.439531, 'drone_id'=> 2, 'plan_id'=> 1],
            ['run_mode' => 'start', 'speed'=> 60, 'lat'=> 30.568762, 'lng'=> 88.439531, 'drone_id'=> 3, 'plan_id'=> 1],
            ['run_mode' => 'start', 'speed'=> 80, 'lat'=> 20.568762, 'lng'=> 50.439531, 'drone_id'=> 5, 'plan_id'=> 3],
            ['run_mode' => 'start', 'speed'=> 80, 'lat'=> 20.568762, 'lng'=> 50.439531, 'drone_id'=> 6, 'plan_id'=> 3],
        ];
        foreach($instructions as $instruction){
            Instruction::create($instruction);
        }
    }
}
