<?php

use Illuminate\Database\Seeder;
use App\Contain;

class ContainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Contain::insert([

        	['name' => 'PIB'],
        	['name' => 'PEB'],
        	['name' => 'SPPB'],
        	['name' => 'SPJM'],
        	['name' => 'BIL'],
        	['name' => 'INSPECTION'],
            ['name' => 'DELIVERY CARGO'],
            ['name' => 'DOC RECEIPT (Copy)'],
            ['name' => 'DOC RECEIPT (Original)'],
        	['name' => 'VESSEL ARRIVAL'],
            ['name' => 'VESSEL DOCKING'],
            ['name' => 'ADVANCE TAKEN'],
            ['name' => 'ADVANCE SETTLED'],
            ['name' => 'D/O PICKUP'],
            ['name' => 'D/O SETTLED'],
            ['name' => 'HICOSCAN'],
            ['name' => 'C/C SETTLED'],
            ['name' => 'CONTAINER DEPOSIT SETTLED'],
            ['name' => 'Others...']

        ]);
    }
}
