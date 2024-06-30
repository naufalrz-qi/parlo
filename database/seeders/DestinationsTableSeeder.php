<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destinations;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Destinations::create([
            'name' => 'Bali Beach',
            'description' => 'A beautiful beach with golden sand and clear waters.',
            'location' => 'Bali, Indonesia',
            'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
            'image' => 'default.jpg',
            'price' => 100000,
        ]);

        Destinations::create([
            'name' => 'Mount Bromo',
            'description' => 'A famous volcano with stunning sunrise views.',
            'location' => 'East Java, Indonesia',
            'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
            'image' => 'default.jpg',
            'price' => 150000,
        ]);

        Destinations::create([
            'name' => 'Ubud Monkey Forest',
            'description' => 'A nature reserve and temple complex home to hundreds of monkeys.',
            'location' => 'Ubud, Bali, Indonesia',
            'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.050080696549!2d116.11370507435205!3d-8.591183687217464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf5c2462a5ed%3A0xbc0f44d683d529b1!2sUniversitas%20Bumigora!5e0!3m2!1sid!2sid!4v1719696895730!5m2!1sid!2sid',
            'image' => 'default.jpg',
            'price' => 50000,
        ]);

        Destinations::create([
            'name' => 'Raja Ampat',
            'description' => 'A pristine archipelago known for its marine biodiversity and coral reefs.',
            'location' => 'West Papua, Indonesia',
            'iframe' => '<iframe src="https://maps.google.com?...</iframe>',
            'image' => 'default.jpg',
            'price' => 200000,
        ]);
    }
}
