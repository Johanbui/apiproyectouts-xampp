<?php

namespace Database\Seeders;

use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolSeeder;
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

        $this->call([
            PermissionSeeder::class,
            RolSeeder::class,
            ListasSeeder::class,
            IdeasSeeder::class,
        ]);
        \App\Models\User::factory(10)->create();

    }
}
