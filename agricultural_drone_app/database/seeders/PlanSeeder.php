<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['name' => 'Spray007', 'type'=> 'Spraying', 'datetime'=> '2023-05-30 16:00', 'density'=> 76, 'map_id'=> 1, 'user_id'=> 1, 'area'=> 'POLYGON((6.535406112670899 46.655990545464206,6.5360498428344735 46.655710711675226,6.535298824310304 46.654561905156164,6.534655094146729 46.654723917810095,6.535406112670899 46.655990545464206))'],
            ['name' => 'Order66', 'type'=> 'Harvesting', 'datetime'=> '2023-05-30 11:00', 'density'=> 86, 'map_id'=> 2, 'user_id'=> 1, 'area'=> 'POLYGON((8.535406112670899 47.655990545464206,6.5360498428344735 46.655710711675226,6.535298824310304 46.654561905156164,6.534655094146729 46.654723917810095,6.535406112670899 46.655990545464206))'],
            ['name' => 'Spray59', 'type'=> 'Spraying', 'datetime'=> '2023-06-01 14:00', 'density'=> 66, 'map_id'=> 5, 'user_id'=> 2, 'area'=> 'POLYGON((6.535406112670899 46.655990545464206,6.5360498428344735 46.655710711675226,6.535298824310304 46.654561905156164,6.534655094146729 46.654723917810095,6.535406112670899 46.655990545464206))'],
        ];
        foreach($plans as $plan){
            Plan::create($plan);
        }
    }
}