<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Trip;
use App\Models\Destination;
use App\Models\TravelerProfile;
use Carbon\Carbon;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = TravelerProfile::with('destination')->get();

        foreach ($profiles->take(10) as $profile) {
            $title = fake()->words(3, true);
            Trip::create([
                'title' => $title,
                'description' => fake()->paragraph,
                'slug' => Str::slug($title) . '-' . Str::random(5),
                'destination_id' => $profile->destination_id,
                'traveler_id' => $profile->id,
                'image' => 'uploads/trips/' . Str::random(10) . '.jpg',
                'start_date' => Carbon::now()->addDays(rand(5, 15))->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(rand(16, 30))->format('Y-m-d'),
            ]);
        }
    }
}
