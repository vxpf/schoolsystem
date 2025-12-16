<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['student_number' => '1234567', 'name' => 'Alivia Williamson', 'opleiding' => '25604BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234568', 'name' => 'Austin Padilla', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234569', 'name' => 'Cole Leon', 'opleiding' => '25604BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234570', 'name' => 'Dale O\'Ryan', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234571', 'name' => 'Dawson Blankenship', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234572', 'name' => 'Dewey Rhodes', 'opleiding' => '25604BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234573', 'name' => 'Eileen Kelly', 'opleiding' => '25604BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234574', 'name' => 'Ella-Louise Heath', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234575', 'name' => 'Ellie-Mae Trujillo', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234576', 'name' => 'Evie Campos', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234577', 'name' => 'Gwen Bonner', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234578', 'name' => 'Joe Boyle', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234579', 'name' => 'Julia Adams', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234580', 'name' => 'Karen Richards', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234581', 'name' => 'Laura Ellis', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234582', 'name' => 'Leila Copeland', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234583', 'name' => 'Martina Roman', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234584', 'name' => 'Molly Cline', 'opleiding' => '25604BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234585', 'name' => 'Sarah Kemp', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234586', 'name' => 'Solomon Ball', 'opleiding' => '25998BOL', 'class' => 'PALVSOD2F'],
            ['student_number' => '1234587', 'name' => 'Victor Gilmore', 'opleiding' => '25604BOL', 'class' => 'PALVSOD2F'],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => strtolower(str_replace(' ', '.', $student['name'])) . '@leerling.tcr.nl',
                'student_number' => $student['student_number'],
                'class' => $student['class'],
                'opleiding' => $student['opleiding'],
                'password' => Hash::make('Welkom2024!'),
                'role' => 'student',
            ]);
        }
    }
}
