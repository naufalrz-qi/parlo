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
            'iframe' => '<iframe src="https://maps.google.com?...</iframe>',
            'image' => 'default.jpg',
            'price' => 100000,
        ]);

        Destinations::create([
            'name' => 'Mount Bromo',
            'description' => 'A famous volcano with stunning sunrise views.',
            'location' => 'East Java, Indonesia',
            'iframe' => '<iframe src="https://maps.google.com?...</iframe>',
            'image' => 'default.jpg',
            'price' => 150000,
        ]);

        Destinations::create([
            'name' => 'Ubud Monkey Forest',
            'description' => 'A nature reserve and temple complex home to hundreds of monkeys.',
            'location' => 'Ubud, Bali, Indonesia',
            'iframe' => '<iframe src="https://maps.google.com?...</iframe>',
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
