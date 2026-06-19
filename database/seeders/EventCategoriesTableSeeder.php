<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventCategory;
use Illuminate\Support\Str;

class EventCategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Academic', 'description' => 'Workshops, seminars, and lectures'],
            ['name' => 'Cultural', 'description' => 'Music, dance, and arts'],
            ['name' => 'Technical', 'description' => 'Hackathons and tech talks'],
            ['name' => 'Sports', 'description' => 'Tournaments and matches'],
        ];

        foreach ($categories as $cat) {
            EventCategory::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
                'is_active' => true,
            ]);
        }
    }
}
