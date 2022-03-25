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
            //DASHBOARD
            array('code' => 'DASHBOARD-ADMIN', 'name'=> 'DashBoard Admin'),
            // CRUD USERS
            array('code' => 'USER-INDEX', 'name'=> 'Listado de Usuarios'),
            array('code' => 'USER-CREATE', 'name'=> 'Crear Usuario'),
            array('code' => 'USER-EDIT', 'name'=> 'Editar Usuario'),
            array('code' => 'USER-TOGGLE', 'name'=> 'Inhabilitar/Habilitar Usuario'),
            array('code' => 'USER-ONE', 'name'=> 'Ver Usuario '),
            // URL ESPECIALES USER
            array('code' => 'USER-KEY', 'name'=> 'Cambiar Contraseña Usuario'),
            // CRUD ROLES
            array('code' => 'ROL-INDEX', 'name'=> 'Listado de Roles'),
            array('code' => 'ROL-CREATE', 'name'=> 'Crear Rol'),
            array('code' => 'ROL-EDIT', 'name'=> 'Editar Rol'),
            array('code' => 'ROL-TOGGLE', 'name'=> 'Inhabilitar/Habilitar Rol'),
            array('code' => 'ROL-ONE', 'name'=> 'Ver Rol'),
            // ROLES PERMISOS
            array('code' => 'ROL-PERMISSION', 'name'=> 'Permiso del Rol'),
            //TRABAJO DE GRADO
            array('code' => 'TRABAJOGRADO-INDEX', 'name'=> 'Trabajo de Grado'),
        );

        DB::table('permissions')->insert($arr);

    }

}
