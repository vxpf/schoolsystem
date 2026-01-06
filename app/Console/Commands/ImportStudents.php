<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ImportStudents extends Command
{
    protected $signature = 'app:import-students {file=studentenschoolsystem.csv}';

    protected $description = 'Import students from CSV file';

    public function handle()
    {
        $filePath = base_path($this->argument('file'));

        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return 1;
        }

        $file = fopen($filePath, 'r');
        $lineNumber = 0;
        $imported = 0;
        $skipped = 0;

        while (($line = fgetcsv($file, 0, ';')) !== false) {
            $lineNumber++;

            if ($lineNumber <= 7) {
                continue;
            }

            if (empty($line[2])) {
                continue;
            }

            $studentNumber = trim($line[2]);
            $name = trim($line[3]);
            $opleiding = trim($line[4]);
            $cohort = trim($line[6]);

            if (empty($studentNumber) || empty($name)) {
                $skipped++;
                continue;
            }

            $existingUser = User::where('student_number', $studentNumber)->first();

            if ($existingUser) {
                $skipped++;
                continue;
            }

            $nameParts = explode(' ', $name, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';

            $email = strtolower(str_replace(' ', '.', $name)) . '@leerling.tcr.nl';

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('Welkom2024!'),
                'student_number' => $studentNumber,
                'opleiding' => $opleiding,
                'class' => 'PALVSOD2F',
                'role' => 'student',
            ]);

            $imported++;

            if ($imported % 10 === 0) {
                $this->line("Imported $imported students...");
            }
        }

        fclose($file);

        $this->info("Import complete!");
        $this->info("Imported: $imported students");
        $this->info("Skipped: $skipped (duplicates or invalid)");

        return 0;
    }
}
