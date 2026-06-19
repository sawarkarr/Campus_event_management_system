<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\User;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    public function run(): void
    {
        $organizer = User::whereHas('roles', function($q) { $q->where('name', 'organizer'); })->first();
        $categories = EventCategory::all();

        $events = [
            [
                'title' => 'Annual Cultural Fest 2024',
                'description' => 'A grand celebration of arts and culture on campus.',
                'category_id' => $categories->where('name', 'Cultural')->first()->id,
                'location' => 'Main Auditorium',
                'start_time' => now()->addDays(10),
                'end_time' => now()->addDays(10)->addHours(5),
                'capacity' => 500,
                'status' => 'published',
            ],
            [
                'title' => 'Tech Hackathon',
                'description' => '24-hour coding challenge for all students.',
                'category_id' => $categories->where('name', 'Technical')->first()->id,
                'location' => 'Computer Lab 1',
                'start_time' => now()->addDays(5),
                'end_time' => now()->addDays(6),
                'capacity' => 100,
                'status' => 'published',
            ],
            [
                'title' => 'Inter-College Sports Meet',
                'description' => 'Various sports competitions including basketball and football.',
                'category_id' => $categories->where('name', 'Sports')->first()->id,
                'location' => 'Campus Ground',
                'start_time' => now()->addDays(15),
                'end_time' => now()->addDays(20),
                'capacity' => 1000,
                'status' => 'published',
            ],
            [
                'title' => 'Workshop: Modern Web Dev',
                'description' => 'Draft workshop about modern web development practices.',
                'category_id' => $categories->where('name', 'Technical')->first()->id,
                'location' => 'Lab 3',
                'start_time' => now()->addDays(25),
                'end_time' => now()->addDays(25)->addHours(3),
                'capacity' => 30,
                'status' => 'draft',
            ],
            [
                'title' => 'Cancelled Seminar',
                'description' => 'This seminar has been cancelled due to unforeseen circumstances.',
                'category_id' => $categories->where('name', 'Academic')->first()->id,
                'location' => 'Seminar Hall B',
                'start_time' => now()->addDays(2),
                'end_time' => now()->addDays(2)->addHours(2),
                'capacity' => 50,
                'status' => 'cancelled',
            ],
        ];

        foreach ($events as $eventData) {
            $eventData['slug'] = Str::slug($eventData['title']) . '-' . rand(1000, 9999);
            $eventData['organizer_id'] = $organizer->id;
            Event::create($eventData);
        }
    }
}
