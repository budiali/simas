<?php

use Illuminate\Database\Seeder;
use App\Box;
use App\Rack;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Box::insert([

        	 [
              'box_number'  => 1 ,
              'from' => \Carbon\Carbon::now('Asia/Jakarta') ,
              'to' => \Carbon\Carbon::now('Asia/Jakarta') ,
              'rack_id' => 1  
            ],
            [
              'box_number'  => 1 ,
              'from' => \Carbon\Carbon::now('Asia/Jakarta') ,
              'to' => \Carbon\Carbon::now('Asia/Jakarta') ,
              'rack_id' => 2
            ],
            [
              'box_number'  => 1 ,
              'from' => \Carbon\Carbon::now('Asia/Jakarta') ,
              'to' => \Carbon\Carbon::now('Asia/Jakarta') ,
              'rack_id' => 3
            ],
            [
              'box_number'  => 1 ,
              'from' => \Carbon\Carbon::now('Asia/Jakarta') ,
              'to' => \Carbon\Carbon::now('Asia/Jakarta') ,
              'rack_id' => 4
            ],

        ]);
    }
}
