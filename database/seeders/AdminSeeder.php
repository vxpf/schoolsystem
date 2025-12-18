<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tcr.nl',
            'password' => Hash::make('admin123'),
            'student_number' => 'ADMIN001',
            'class' => 'N/A',
            'opleiding' => 'Administrator',
            'role' => 'admin',
        ]);
    }
}
