<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Destinations;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('destinations')->insert([
            [
                'name' => 'Pantai Kuta Lombok',
                'description' => 'Pantai dengan pasir putih dan ombak yang cocok untuk berselancar.',
                'location' => 'Kuta, Lombok Tengah, Nusa Tenggara Barat',
                'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
                'image' => 'default.jpg',
                'price' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gunung Rinjani',
                'description' => 'Gunung tertinggi kedua di Indonesia dengan pemandangan yang menakjubkan.',
                'location' => 'Lombok Timur, Nusa Tenggara Barat',
                'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
                'image' => 'default.jpg',
                'price' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gili Trawangan',
                'description' => 'Pulau kecil dengan pantai yang indah dan kehidupan malam yang ramai.',
                'location' => 'Gili Indah, Lombok Utara, Nusa Tenggara Barat',
                'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
                'image' => 'default.jpg',
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desa Sade',
                'description' => 'Desa tradisional Sasak yang mempertahankan budaya dan tradisi Lombok.',
                'location' => 'Rembitan, Lombok Tengah, Nusa Tenggara Barat',
                'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
                'image' => 'default.jpg',
                'price' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pantai Tanjung Aan',
                'description' => 'Pantai dengan pasir merica dan air laut yang jernih.',
                'location' => 'Kuta, Lombok Tengah, Nusa Tenggara Barat',
                'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
                'image' => 'default.jpg',
                'price' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Air Terjun Tiu Kelep',
                'description' => 'Air terjun indah di kaki Gunung Rinjani.',
                'location' => 'Senaru, Lombok Utara, Nusa Tenggara Barat',
                'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
                'image' => 'default.jpg',
                'price' => 75000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
