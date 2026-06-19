<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'display_name' => 'Administrator'],
            ['name' => 'organizer', 'display_name' => 'Event Organizer'],
            ['name' => 'student', 'display_name' => 'Student'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
