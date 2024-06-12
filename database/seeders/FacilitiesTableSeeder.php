<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'name' => 'Mountain Resort',
            'description' => 'A beautiful mountain resort with stunning views.',
            'location' => 'Mountain Road, Alpine Town',
            'opening_hours' => '08:00 - 20:00',
            'contact_info' => '0123456789',
            'type' => 'Resort',
        ]);

        Facility::create([
            'name' => 'City Museum',
            'description' => 'A museum showcasing the history of the city.',
            'location' => 'Main Street, City Center',
            'opening_hours' => '09:00 - 17:00',
            'contact_info' => '0987654321',
            'type' => 'Museum',
        ]);

        Facility::create([
            'name' => 'Beach Club',
            'description' => 'A club on the beach with various amenities.',
            'location' => 'Beach Road, Seaside Town',
            'opening_hours' => '10:00 - 22:00',
            'contact_info' => '0123487654',
            'type' => 'Club',
        ]);
    }
}
