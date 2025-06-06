<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            $title = $faker->sentence(6, true);
            Blog::create([
                'title'         => $title,
                'content'       => $faker->paragraphs(5, true),
                'author'        => $faker->name,
                'slug'          => Str::slug($title) . '-' . $i,
                'image'         => 'default.jpg', // or use $faker->imageUrl()
                'is_published'  => $faker->boolean(80),
                'published_at'  => $faker->dateTimeBetween('-1 year', 'now'),
                'category'      => $faker->randomElement(['Travel', 'Tips', 'Experience', 'Guide']),
                'tags'          => implode(',', $faker->words(4)), // e.g., "adventure,travel,nature,fun"
            ]);
        }
    }
}
