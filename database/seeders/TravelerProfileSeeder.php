<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\TravelerProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TravelerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'traveler')->inRandomOrder()->take(10)->get();
        $destinations = Destination::pluck('id')->toArray();

        $interestsList = ['hiking', 'wildlife', 'beaches', 'culture', 'photography', 'road trips'];
        $preferencesList = ['guided tours', 'local food', 'solo travel', 'luxury stays'];
        $budgets = ['low', 'medium', 'high'];
        $durations = ['1 week', '2 weeks', '10 days'];
        $companions = ['solo', 'couple', 'family'];
        $experiences = ['beginner', 'intermediate', 'expert'];
        $styles = ['budget', 'adventure', 'luxury'];

        foreach ($users as $user) {
            TravelerProfile::create([
                'user_id' => $user->id,
                'bio' => 'I love exploring Rwanda and creating new memories.',
                'interests' => implode(',', fake()->randomElements($interestsList, rand(2, 4))),
                'destination_id' => fake()->randomElement($destinations),
                'travel_preferences' => implode(',', fake()->randomElements($preferencesList, rand(1, 3))),
                'travel_budget' => fake()->randomElement($budgets),
                'travel_duration' => fake()->randomElement($durations),
                'travel_companions' => fake()->randomElement($companions),
                'travel_experience' => fake()->randomElement($experiences),
                'travel_style' => fake()->randomElement($styles),
                'travel_photos' => 'uploads/photos/' . Str::random(10) . '.jpg',
                'start_date' => Carbon::now()->addDays(rand(5, 20)),
                'end_date' => Carbon::now()->addDays(rand(21, 40)),
                'price' => rand(500, 3000),
                'is_active' => true,
                'is_verified' => fake()->boolean(40),
                'is_featured' => fake()->boolean(20),
            ]);
        }
    }
}
