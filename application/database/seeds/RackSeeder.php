<?php

use Illuminate\Database\Seeder;
use App\Rack;
use App\Division;

class RackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Rack::insert([

        	['rack_number' => 1 , 'capacity' => 12 ,'division_id' => 1] ,
        	['rack_number' => 2 , 'capacity' => 12 ,'division_id' => 2] ,
            ['rack_number' => 3 , 'capacity' => 12 ,'division_id' => 3] ,
            ['rack_number' => 4 , 'capacity' => 12 ,'division_id' => 4] ,
        
        ]);
    }
}
