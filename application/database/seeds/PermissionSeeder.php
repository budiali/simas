<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'name' => 'Show Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Create Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Edit Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Update Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Detail Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Print Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Delete Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Show Trash Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Restore Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Restore All Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Delete Permanently Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Delete Permanently All Documents',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Show Box',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Create Box',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Edit Box',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Update Box',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Detail Box',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Delete Box',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Update Status Box',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Show Racks',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Create Racks',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Edit Racks',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Update Racks',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Detail Racks',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Delete Racks',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Show Division',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Create Division',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Edit Division',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Update Division',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Delete Division',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Show Users',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Create Users',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Show User Roles',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Set User Roles',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
            [
                'name' => 'Delete Users',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") 
            ],
           
        ]);
    }
}
