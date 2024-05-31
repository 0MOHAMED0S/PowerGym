<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UssContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact = [
            [
                'location' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d220773.76547469312!2d31.250767094531245!3d30.163133499999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14581dc12723bc67%3A0xa4adce36787bc56c!2spower%20gym!5e0!3m2!1sen!2seg!4v1712841605318!5m2!1sen!2seg',
                'phone' => '01110562097',
                'email'=>'Gym@gmail.com',
            ],
        ];

        // Insert  into the database
        Contact::insert($contact);
    }
}
