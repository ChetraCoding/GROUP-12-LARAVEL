<?php

namespace Database\Seeders;

use App\Models\Map;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maps = [
            ['farm_id' => 1, 'drone_id'=> 1, 'image'=> "data:image/png;base64, iVBAAQVQI12P4//8/w38GIAXDIABJRU5ErkJggg=="],
            ['farm_id' => 1, 'drone_id'=> 1, 'image'=> "data:image/png;base64, dDFDSKFHKDJKAFDF///DSADSADSADSADASDUuudjsd"],
            ['farm_id' => 2, 'drone_id'=> 1, 'image'=> "data:image/png;base64, iVBAAQVQI12P4//8/w38GIAXDIABJRU5ErkJddsadsa"],
            ['farm_id' => 2, 'drone_id'=> 1, 'image'=> "data:image/png;base64, dDFDSKFHKDJKAFDF///DDSDADADewDASDSASDA"],
            ['farm_id' => 3, 'drone_id'=> 4, 'image'=> "data:image/png;base64, oDSADASDASBVCXVCXC///DDSDREWERWEREWRRRRASDA"],
        ];
        foreach($maps as $map){
            Map::create($map);
        }
    }
}