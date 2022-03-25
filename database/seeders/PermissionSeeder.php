<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arr = array(
            // CRUD USERS
            array('code' => 'USER-INDEX', 'name'=> 'Index Users'),
            array('code' => 'USER-CREATE', 'name'=> 'Create User'),
            array('code' => 'USER-EDIT', 'name'=> 'Edit User'),
            array('code' => 'USER-TOGGLE', 'name'=> 'Toggle Users'),
            array('code' => 'USER-ONE', 'name'=> 'User'),
            // URL ESPECIALES USER
            array('code' => 'USER-KEY', 'name'=> 'Key User'),
            array('code' => 'ROL-INDEX', 'name'=> 'Index Roles'),
            // CRUD ROLES
            array('code' => 'ROLES-INDEX', 'name'=> 'Index Users Roles'),
            array('code' => 'ROLES-CREATE', 'name'=> 'Create Rol'),
            array('code' => 'ROLES-EDIT', 'name'=> 'Edit Rol'),
            array('code' => 'ROLES-TOGGLE', 'name'=> 'Toggle User Roles'),
            array('code' => 'ROLES-ONE', 'name'=> 'Rol'),
            // ROLES PERMISOS
            array('code' => 'ROLES-PERMISSIONS', 'name'=> 'Roles Permissions'),

        );

        DB::table('permissions')->insert($arr);

    }

}
