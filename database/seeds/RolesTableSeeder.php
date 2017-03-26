<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Super Admin',
            'slug' => 'super',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Manager',
            'slug' => 'manager',
        ]);

    }
}
