<?php

use Illuminate\Database\Seeder;
use App\Division;
use App\Rack;
use App\User;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Division::insert([

        	['name' => 'IT','descriptions' => 'null'],
        	['name' => 'Finance','descriptions' => 'null' ],
            ['name' => 'Human Resource','descriptions' => 'null' ],
            ['name' => 'Sekretaris','descriptions' => 'null' ]

        ]);
    }
}
