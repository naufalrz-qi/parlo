<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Facility;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facilities')->insert([
            [
                'name' => 'Surfing Lesson',
                'description' => 'Pelajaran berselancar untuk pemula dan tingkat lanjut.',
                'location' => 'Pantai Kuta Lombok',
                'opening_hours' => '08:00 - 18:00',
                'contact_info' => '081234567890',
                'type' => 'Sport',
                'price' => 300000,
                'image' => 'default.jpg',
                'destination_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Camping Area',
                'description' => 'Tempat berkemah dengan pemandangan Gunung Rinjani.',
                'location' => 'Gunung Rinjani',
                'opening_hours' => '24 Jam',
                'contact_info' => '081234567891',
                'type' => 'Outdoor',
                'price' => 200000,
                'image' => 'default.jpg',
                'destination_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Snorkeling Equipment Rental',
                'description' => 'Penyewaan peralatan snorkeling untuk menikmati keindahan bawah laut Gili Trawangan.',
                'location' => 'Gili Trawangan',
                'opening_hours' => '08:00 - 17:00',
                'contact_info' => '081234567892',
                'type' => 'Water Sport',
                'price' => 150000,
                'image' => 'default.jpg',
                'destination_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Traditional Dance Show',
                'description' => 'Pertunjukan tari tradisional Sasak di Desa Sade.',
                'location' => 'Desa Sade',
                'opening_hours' => '09:00 - 15:00',
                'contact_info' => '081234567893',
                'type' => 'Cultural',
                'price' => 50000,
                'image' => 'default.jpg',
                'destination_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kayak Rental',
                'description' => 'Penyewaan kayak untuk berkeliling Pantai Tanjung Aan.',
                'location' => 'Pantai Tanjung Aan',
                'opening_hours' => '08:00 - 17:00',
                'contact_info' => '081234567894',
                'type' => 'Water Sport',
                'price' => 100000,
                'image' => 'default.jpg',
                'destination_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Guided Waterfall Trekking',
                'description' => 'Pendakian dengan pemandu ke Air Terjun Tiu Kelep.',
                'location' => 'Air Terjun Tiu Kelep',
                'opening_hours' => '07:00 - 16:00',
                'contact_info' => '081234567895',
                'type' => 'Outdoor',
                'price' => 250000,
                'image' => 'default.jpg',
                'destination_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
