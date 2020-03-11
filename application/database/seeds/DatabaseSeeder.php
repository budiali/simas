<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RackSeeder::class);
        $this->call(BoxSeeder::class);
        $this->call(ContainSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
