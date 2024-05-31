<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Social = [
            [
                'social_type' => 'form',
                'user_id' => '1',
            ],
        ];

        // Insert  into the database
        Social::insert($Social);
    }
}
