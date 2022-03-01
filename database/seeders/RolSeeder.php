<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arr = array(
            array('code' => 'USER-INDEX', 'name'=> 'Index Users', 'enable' => true),
            array('code' => 'USER-CREATE', 'name'=> 'Create User', 'enable' => true),
            array('code' => 'USER-EDIT', 'name'=> 'Edit User', 'enable' => true),
            array('code' => 'USER-ONE', 'name'=> 'User', 'enable' => true),
            array('code' => 'USER-KEY', 'name'=> 'Key User', 'enable' => true),
            array('code' => 'USERS-ROLES-INDEX', 'name'=> 'Index Users Roles', 'enable' => true),
            array('code' => 'ROL-INDEX', 'name'=> 'Index Roles', 'enable' => true)
        );

        DB::table('roles')->insert($arr);

        $arr = array(
            array('user_id' => '1', 'rol_id'=> '1', 'enable' => true),
            array('user_id' => '1', 'rol_id'=> '2', 'enable' => true),
            array('user_id' => '1', 'rol_id'=> '3', 'enable' => true),
            array('user_id' => '1', 'rol_id'=> '4', 'enable' => true),
            array('user_id' => '1', 'rol_id'=> '5', 'enable' => true),
            array('user_id' => '1', 'rol_id'=> '6', 'enable' => true),
            array('user_id' => '1', 'rol_id'=> '7', 'enable' => true),
        );

        DB::table('users_roles')->insert($arr);

    }

}
