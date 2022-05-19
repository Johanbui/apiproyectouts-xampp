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
            array('code' => 'COORDINADOR', 'name'=> 'Coordinador', 'enable' => true),
            array('code' => 'DOCENTE', 'name'=> 'Docente', 'enable' => true),
            array('code' => 'ESTUDIANTE', 'name'=> 'Estudiante', 'enable' => true),
        );

        DB::table('roles')->insert($arr);

        $arr = array(
            array('rol_id' => '1', 'permission_id'=> '1', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '2', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '3', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '4', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '5', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '6', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '7', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '8', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '9', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '10', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '11', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '12', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '13', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '14', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '15', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '16', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '17', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '18', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '19', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '20', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '21', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '22', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '23', 'enable' => true),
            array('rol_id' => '1', 'permission_id'=> '24', 'enable' => true),

            array('rol_id' => '4', 'permission_id'=> '1', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '2', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '3', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '4', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '5', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '6', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '7', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '8', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '9', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '10', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '11', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '12', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '13', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '14', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '15', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '16', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '17', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '18', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '19', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '20', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '21', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '22', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '23', 'enable' => true),
            array('rol_id' => '4', 'permission_id'=> '24', 'enable' => true),
        );
        DB::table('roles_permissions')->insert($arr);

    }

}
