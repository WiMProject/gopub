<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrator with full access'
            ],
            [
                'name' => 'publisher',
                'description' => 'Publisher with publication management access'
            ],
            [
                'name' => 'user',
                'description' => 'Regular user with limited access'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}