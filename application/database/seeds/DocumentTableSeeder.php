<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 10; $i++)
        {
        	DB::table('document')->insert([

        		'reference_number' => $faker -> randomNumber($nbDigits = NULL, $strict = false),
        		'job_number' => $faker -> numberBetween($min = 1000, $max = 9000)."GA" ,
        		'name_document' => $faker -> company() ,
        		'date' => $faker -> date($format = 'Y-m-d', $max = 'now') ,
        		'box_id' => $faker -> numberBetween($min = 1, $max = 9) ,
        		'description' => $faker -> text($maxNbChars = 120) ,

        	]);
        }
    }
}
