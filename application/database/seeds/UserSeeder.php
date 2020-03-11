<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Division;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_administrator = Role::where('name','administrator')->first();
        $user_manager = Role::where('name','manager')->first();
        $user_staff = Role::where('name','staff')->first();

        $admin = new User();
        $admin -> name = 'User Administrator';
        $admin -> division_id = 1;
        $admin -> email = 'administrator@gmail.com';
        $admin -> password = bcrypt('secret');
        $admin -> save();
        $admin -> roles() -> attach($user_administrator);

        $admin = new User();
        $admin -> name = 'User Manager';
        $admin -> division_id = 2;
        $admin -> email = 'manager@gmail.com';
        $admin -> password = bcrypt('secret');
        $admin -> save();
        $admin -> roles() -> attach($user_manager);

        $admin = new User();
        $admin -> name = 'User Staff';
        $admin -> division_id = 3;
        $admin -> email = 'staff@gmail.com';
        $admin -> password = bcrypt('secret');
        $admin -> save();
        $admin -> roles() -> attach($user_staff);

    }
}
