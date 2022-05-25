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
            // NOTIFICACIONES
            array('code' => 'NOTIFICACIONES-INDEX', 'name' => 'Notificaciones'),
            // CRUD ACTAS
            array('code' => 'ACTA-INDEX', 'name'=> 'Listado de Actas'),
            array('code' => 'ACTA-CREATE', 'name'=> 'Crear Acta'),
            array('code' => 'ACTA-EDIT', 'name'=> 'Editar Acta'),
            array('code' => 'ACTA-TOGGLE', 'name'=> 'Inhabilitar/Habilitar Acta'),
            array('code' => 'ACTA-ONE', 'name'=> 'Ver Acta '),

            // CRUD IDEAS
            array('code' => 'IDEA-INDEX', 'name'=> 'Listado de Ideas'),
            array('code' => 'IDEA-CREATE', 'name'=> 'Crear Idea'),
            array('code' => 'IDEA-EDIT', 'name'=> 'Editar Idea'),
            array('code' => 'IDEA-TOGGLE', 'name'=> 'Inhabilitar/Habilitar Idea'),
            array('code' => 'IDEA-ONE', 'name'=> 'Ver Idea'),

        );

        DB::table('permissions')->insert($arr);

    }

}
