<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'opti',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'mi',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'ame',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'kme',
            'guard_name' => 'web'
        ]);
    }
}
