<?php

use Illuminate\Database\Seeder;
// use App\Role;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_administrator = new Role();
        $role_administrator -> name = 'administrator';
        $role_administrator -> save();

        $role_manager = new Role();
        $role_manager -> name = 'manager';
        $role_manager -> save();

        $role_staff = new Role();
        $role_staff -> name = 'staff';
        $role_staff -> save();
    }
}
