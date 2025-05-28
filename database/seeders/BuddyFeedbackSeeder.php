<?php

namespace Database\Seeders;

use App\Models\BuddyFeedback;
use App\Models\TravelerProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuddyFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $travelers = TravelerProfile::all();
        $users = User::all();

        // Ensure there's enough data
        if ($travelers->isEmpty() || $users->isEmpty()) {
            $this->command->warn('TravelerProfiles or Users table is empty.');
            return;
        }

        foreach ($users as $user) {
            $buddy = $travelers->random();

            BuddyFeedback::create([
                'buddy_id' => $buddy->id,
                'user_id' => $user->id,
                'rating' => rand(3, 5),
                'comment' => fake()->sentence(),
            ]);
        }
    }
}
