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
        $keuzedelen = Keuzedeel::all();
        $movedCount = 0;

        foreach ($keuzedelen as $keuzedeel) {
            $enrolledCount = $keuzedeel->users()
                ->wherePivot('status', 'goedgekeurd')
                ->count();

            if ($enrolledCount < $keuzedeel->min_studenten) {
                $studentsToMove = $keuzedeel->users()
                    ->wherePivot('status', 'goedgekeurd')
                    ->get();

                foreach ($studentsToMove as $student) {
                    $secondChoice = $student->pivot->second_choice_keuzedeel_id;

                    if ($secondChoice) {
                        $secondKeuzedeel = Keuzedeel::find($secondChoice);

                        if ($secondKeuzedeel) {
                            $keuzedeel->users()->detach($student->id);
                            $secondKeuzedeel->users()->attach($student->id, [
                                'status' => 'goedgekeurd'
                            ]);

                            Notification::create([
                                'user_id' => $student->id,
                                'keuzedeel_id' => $secondChoice,
                                'type' => 'fallback',
                                'title' => 'Automatisch naar 2e keuze verplaatst',
                                'message' => 'Je eerste keuze "' . $keuzedeel->naam . '" had onvoldoende inschrijvingen. Je bent automatisch ingeschreven voor je tweede keuze: "' . $secondKeuzedeel->naam . '".',
                            ]);

                            $movedCount++;
                        }
                    }
                }
            }
        }

        $this->info("$movedCount studenten verplaatst naar hun 2e keuze.");
    }
}
