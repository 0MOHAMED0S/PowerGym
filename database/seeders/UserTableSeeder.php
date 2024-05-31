<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'SuperAdmin',
                'email' => 'suberadmin@gmail.com',
                'role'=>'SuberAdmin',
                'email_verified_at' => '2024-04-21 22:32:40',
                'password' => Hash::make('10203040'),
            ],
        ];

        // Insert users into the database
        User::insert($users);
    }
}
