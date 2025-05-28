<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            'Kigali',
            'Musanze',
            'Rubavu',
            'Nyungwe Forest',
            'Akagera National Park',
            'Karongi',
            'Huye',
            'Nyanza',
            'Gicumbi',
            'Bugesera',
        ];

        foreach ($destinations as $name) {
            Destination::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'country' => 'Rwanda',
                'image' => 'default.jpg', // Replace or randomize as needed
                'description' => "Explore the beauty of $name in Rwanda.",
            ]);
        }
    }
}
