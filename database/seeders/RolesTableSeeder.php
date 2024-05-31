<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin',],
            ['name' => 'User'],
            ['name' => 'SuberAdmin'],
            ['name' => 'Coache'],

        ];

        // Insert roles into the database
        Role::insert($roles);
    }
}
