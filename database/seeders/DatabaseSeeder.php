<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Social;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RolesTableSeeder::class,
            UserTableSeeder::class,
            LogoNameSeeder::class,
            UssContactTableSeeder::class,
            SocialTableSeeder::class

        ]);
        // User::factory()->create([
        // ]);
    }
}
