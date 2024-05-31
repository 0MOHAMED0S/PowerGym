<?php

namespace Database\Seeders;

use App\Models\LogoName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogoNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logo = [
            [
                'logopath' => null,
                'firstname' => 'power',
                'secondname'=>'Gym',
            ],
        ];

        // Insert  into the database
        LogoName::insert($logo);
    }
}
