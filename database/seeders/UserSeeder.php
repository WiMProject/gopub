<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get role IDs
        $adminRole = Role::where('name', 'admin')->first();
        $publisherRole = Role::where('name', 'publisher')->first();
        $userRole = Role::where('name', 'user')->first();

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'bio' => 'System administrator',
            'institution' => 'GoPub Organization'
        ]);

        // Create publisher users (100 users)
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name' => "Publisher $i",
                'email' => "publisher$i@example.com",
                'password' => Hash::make('password'),
                'role_id' => $publisherRole->id,
                'bio' => "Publisher bio $i",
                'institution' => "Institution $i"
            ]);
        }

        // Create regular users (100 users)
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'role_id' => $userRole->id,
                'bio' => "User bio $i",
                'institution' => "Institution " . ($i + 100)
            ]);
        }
    }
}