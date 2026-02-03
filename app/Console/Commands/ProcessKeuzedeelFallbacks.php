<?php

namespace App\Console\Commands;

use App\Models\Keuzedeel;
use App\Models\Notification;
use Illuminate\Console\Command;

class ProcessKeuzedeelFallbacks extends Command
{
    protected $signature = 'keuzedeel:process-fallbacks';
    protected $description = 'Move students to 2nd choice if 1st choice has insufficient enrollments';

    public function handle()
    {
        $keuzedelen = Keuzedeel::where('actief', true)->get();
        $movedCount = 0;

        foreach ($keuzedelen as $keuzedeel) {
            $enrolledCount = $keuzedeel->users()
                ->wherePivot('status', 'goedgekeurd')
                ->wherePivot('assignment_status', '!=', 'second_choice')
                ->count();

            if ($enrolledCount < $keuzedeel->min_studenten) {
                $this->info("Processing '{$keuzedeel->naam}': {$enrolledCount}/{$keuzedeel->min_studenten} enrollments");
                
                $studentsToMove = $keuzedeel->users()
                    ->wherePivot('status', 'goedgekeurd')
                    ->wherePivot('assignment_status', '!=', 'second_choice')
                    ->whereNotNull('pivot.second_choice_keuzedeel_id')
                    ->get();

                foreach ($studentsToMove as $student) {
                    $secondChoiceId = $student->pivot->second_choice_keuzedeel_id;

                    if ($secondChoiceId) {
                        $secondKeuzedeel = Keuzedeel::find($secondChoiceId);

                        if ($secondKeuzedeel && $secondKeuzedeel->actief) {
                            // Check if second choice has space
                            $secondChoiceCount = $secondKeuzedeel->users()
                                ->wherePivot('status', 'goedgekeurd')
                                ->count();

                            if ($secondChoiceCount < $secondKeuzedeel->max_studenten) {
                                // Update first choice to rejected
                                $keuzedeel->users()->updateExistingPivot($student->id, [
                                    'status' => 'afgewezen',
                                    'assignment_status' => 'second_choice'
                                ]);

                                // Add to second choice
                                $secondKeuzedeel->users()->attach($student->id, [
                                    'status' => 'goedgekeurd',
                                    'assignment_status' => 'second_choice'
                                ]);

                                Notification::create([
                                    'user_id' => $student->id,
                                    'keuzedeel_id' => $secondChoiceId,
                                    'type' => 'reassignment',
                                    'title' => 'Automatisch naar 2e keuze verplaatst',
                                    'message' => 'Je eerste keuze "' . $keuzedeel->naam . '" had onvoldoende inschrijvingen. Je bent automatisch ingeschreven voor je tweede keuze: "' . $secondKeuzedeel->naam . '".',
                                ]);

                                $movedCount++;
                                $this->info("  → Moved {$student->name} to '{$secondKeuzedeel->naam}'");
                            }
                        }
                    }
                }
            }
        }

        $this->info("✓ Process complete. {$movedCount} students moved to 2nd choice.");
    }
}
