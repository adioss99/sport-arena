<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@sportarena.com',
                'password' => Hash::make('password123'),
                'role_id' => Role::where('name', 'superadmin')->first()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@sportarena.com',
                'password' => Hash::make('password123'),
                'role_id' => Role::where('name', 'admin')->first()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert users
        User::insert($users);
    }
}
