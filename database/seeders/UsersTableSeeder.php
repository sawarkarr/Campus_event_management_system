<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $organizerRole = Role::where('name', 'organizer')->first();
        $studentRole = Role::where('name', 'student')->first();

        // Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@campus.com',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);
        $admin->roles()->attach($adminRole);

        // Organizer
        $organizer = User::create([
            'name' => 'Organizer User',
            'email' => 'organizer@campus.com',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);
        $organizer->roles()->attach($organizerRole);

        // Student
        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@campus.com',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);
        $student->roles()->attach($studentRole);
    }
}
