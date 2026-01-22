<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalKeuzedelen = Keuzedeel::count();
        $totalEnrollments = DB::table('keuzedeel_user')->count();
        $activeKeuzedelen = Keuzedeel::where('actief', true)->count();
        
        // Keuzedelen met te weinig inschrijvingen (minder dan 30% van max_studenten)
        $keuzedelenMetWeinigInschrijvingen = Keuzedeel::where('actief', true)
            ->withCount('users')
            ->get()
            ->filter(function($keuzedeel) {
                $percentage = $keuzedeel->max_studenten > 0 ? ($keuzedeel->users_count / $keuzedeel->max_studenten) * 100 : 0;
                return $percentage < 30 && $percentage > 0;
            });

        // Data voor grafieken
        // 1. Inschrijvingen per keuzedeel (top 6)
        $inschrijvingenPerKeuzedeel = Keuzedeel::withCount('users')
            ->orderBy('users_count', 'desc')
            ->limit(6)
            ->get()
            ->map(function($keuzedeel) {
                return [
                    'naam' => $keuzedeel->naam,
                    'code' => $keuzedeel->code,
                    'count' => $keuzedeel->users_count,
                    'max' => $keuzedeel->max_studenten
                ];
            });

        // 2. Status verdeling
        $statusVerdeling = DB::table('keuzedeel_user')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        // 3. Inschrijvingen per periode
        $inschrijvingenPerPeriode = Keuzedeel::withCount('users')
            ->get()
            ->groupBy('periode')
            ->map(function($keuzedelen) {
                return $keuzedelen->sum('users_count');
            });

        // 4. Bezettingsgraad per keuzedeel
        $bezettingsgraad = Keuzedeel::withCount('users')
            ->where('actief', true)
            ->get()
            ->map(function($keuzedeel) {
                $percentage = $keuzedeel->max_studenten > 0 
                    ? round(($keuzedeel->users_count / $keuzedeel->max_studenten) * 100) 
                    : 0;
                return [
                    'naam' => $keuzedeel->naam,
                    'percentage' => $percentage,
                    'count' => $keuzedeel->users_count,
                    'max' => $keuzedeel->max_studenten
                ];
            })
            ->sortByDesc('percentage')
            ->take(5);

        return view('admin.dashboard', compact(
            'totalStudents', 
            'totalKeuzedelen', 
            'totalEnrollments', 
            'activeKeuzedelen', 
            'keuzedelenMetWeinigInschrijvingen',
            'inschrijvingenPerKeuzedeel',
            'statusVerdeling',
            'inschrijvingenPerPeriode',
            'bezettingsgraad'
        ));
    }

    public function students()
    {
        $students = User::where('role', 'student')
            ->withCount('keuzedelen')
            ->orderBy('name')
            ->get();

        return view('admin.students', compact('students'));
    }

    public function enrollments()
    {
        $keuzedelen = Keuzedeel::withCount('users')
            ->with(['users' => function($query) {
                $query->orderBy('keuzedeel_user.created_at', 'desc');
            }])
            ->orderBy('naam')
            ->get();

        return view('admin.enrollments', compact('keuzedelen'));
    }

    public function enrollmentsByKeuzedeel(Keuzedeel $keuzedeel)
    {
        $students = $keuzedeel->users()
            ->orderBy('keuzedeel_user.created_at', 'desc')
            ->get();

        return view('admin.enrollments-detail', compact('keuzedeel', 'students'));
    }

    public function keuzedeelIndex()
    {
        $keuzedelen = Keuzedeel::withCount('users')
            ->orderBy('naam')
            ->get();

        return view('admin.keuzedelen.index', compact('keuzedelen'));
    }

    public function keuzedeelCreate()
    {
        return view('admin.keuzedelen.create');
    }

    public function keuzedeelStore(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'wat_leer_je' => 'nullable|string',
            'code' => 'required|string|unique:keuzedelen',
            'studiepunten' => 'required|integer|min:0',
            'niveau' => 'nullable|string|max:255',
            'max_studenten' => 'required|integer|min:1',
            'min_studenten' => 'required|integer|min:1',
        ]);

        $validated['actief'] = $request->has('actief');

        Keuzedeel::create($validated);

        return redirect()->route('admin.keuzedelen.index')
            ->with('success', 'Keuzedeel succesvol aangemaakt!');
    }

    public function keuzedeelEdit(Keuzedeel $keuzedeel)
    {
        return view('admin.keuzedelen.edit', compact('keuzedeel'));
    }

    public function keuzedeelUpdate(Request $request, Keuzedeel $keuzedeel)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'wat_leer_je' => 'nullable|string',
            'code' => 'required|string|unique:keuzedelen,code,' . $keuzedeel->id,
            'studiepunten' => 'required|integer|min:0',
            'niveau' => 'nullable|string|max:255',
            'max_studenten' => 'required|integer|min:1',
            'min_studenten' => 'required|integer|min:1',
        ]);

        // Bewaar oude waarden voor vergelijking
        $oudeNaam = $keuzedeel->naam;
        $wasActief = $keuzedeel->actief;

        $validated['actief'] = $request->has('actief');

        $keuzedeel->update($validated);

        // Stuur notificaties naar ingeschreven studenten bij belangrijke wijzigingen
        $ingeschrevenStudenten = $keuzedeel->users()
            ->wherePivot('status', '!=', 'voltooid')
            ->get();

        if ($ingeschrevenStudenten->count() > 0) {
            // Notificatie als keuzedeel inactief wordt gezet
            if ($wasActief && !$validated['actief']) {
                foreach ($ingeschrevenStudenten as $student) {
                    Notification::create([
                        'user_id' => $student->id,
                        'keuzedeel_id' => $keuzedeel->id,
                        'type' => 'wijziging',
                        'title' => 'Keuzedeel gedeactiveerd',
                        'message' => 'Het keuzedeel "' . $keuzedeel->naam . '" is tijdelijk gedeactiveerd. Neem contact op met je docent voor meer informatie.',
                    ]);
                }
            }
            // Notificatie bij andere wijzigingen
            else {
                $wijzigingen = [];
                if ($oudeNaam !== $validated['naam']) {
                    $wijzigingen[] = 'naam gewijzigd naar "' . $validated['naam'] . '"';
                }
                
                if (count($wijzigingen) > 0 || $request->has('notify_students')) {
                    foreach ($ingeschrevenStudenten as $student) {
                        Notification::create([
                            'user_id' => $student->id,
                            'keuzedeel_id' => $keuzedeel->id,
                            'type' => 'wijziging',
                            'title' => 'Keuzedeel bijgewerkt',
                            'message' => 'Het keuzedeel "' . $keuzedeel->naam . '" is bijgewerkt. Bekijk de details voor de laatste informatie.',
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.keuzedelen.index')
            ->with('success', 'Keuzedeel succesvol bijgewerkt!');
    }

    public function keuzedeelDestroy(Keuzedeel $keuzedeel)
    {
        $enrollmentCount = $keuzedeel->users()->count();
        
        if ($enrollmentCount > 0) {
            return back()->with('error', 'Kan keuzedeel niet verwijderen. Er zijn nog ' . $enrollmentCount . ' studenten ingeschreven.');
        }

        $keuzedeel->delete();

        return redirect()->route('admin.keuzedelen.index')
            ->with('success', 'Keuzedeel succesvol verwijderd!');
    }

    public function updateEnrollmentStatus(Request $request, Keuzedeel $keuzedeel, User $user)
    {
        $validated = $request->validate([
            'status' => 'required|in:aangemeld,goedgekeurd,afgewezen,voltooid',
            'cijfer' => 'nullable|numeric|min:1|max:10'
        ]);

        $oldStatus = $keuzedeel->users()->where('user_id', $user->id)->first()->pivot->status;

        $updateData = [
            'status' => $validated['status']
        ];

        if (isset($validated['cijfer'])) {
            $updateData['cijfer'] = $validated['cijfer'];
        }

        $keuzedeel->users()->updateExistingPivot($user->id, $updateData);

        if ($validated['status'] === 'afgewezen' && $oldStatus !== 'afgewezen') {
            Notification::create([
                'user_id' => $user->id,
                'keuzedeel_id' => $keuzedeel->id,
                'type' => 'afwijzing',
                'title' => 'Keuzedeel afgewezen',
                'message' => 'Je aanmelding voor het keuzedeel "' . $keuzedeel->naam . '" is helaas afgewezen. Neem contact op met je docent voor meer informatie.',
            ]);
        }

        if ($validated['status'] === 'goedgekeurd' && $oldStatus !== 'goedgekeurd') {
            Notification::create([
                'user_id' => $user->id,
                'keuzedeel_id' => $keuzedeel->id,
                'type' => 'goedkeuring',
                'title' => 'Keuzedeel goedgekeurd',
                'message' => 'Je aanmelding voor het keuzedeel "' . $keuzedeel->naam . '" is goedgekeurd! Je kunt nu beginnen met dit keuzedeel.',
            ]);
        }

        if ($validated['status'] === 'voltooid' && $oldStatus !== 'voltooid') {
            Notification::create([
                'user_id' => $user->id,
                'keuzedeel_id' => $keuzedeel->id,
                'type' => 'voltooiing',
                'title' => 'Keuzedeel voltooid',
                'message' => 'Gefeliciteerd! Je hebt het keuzedeel "' . $keuzedeel->naam . '" succesvol voltooid.',
            ]);
        }

        return back()->with('success', 'Status succesvol bijgewerkt!');
    }

    public function removeEnrollment(Keuzedeel $keuzedeel, User $user)
    {
        // Stuur notificatie naar student voordat we de inschrijving verwijderen
        Notification::create([
            'user_id' => $user->id,
            'keuzedeel_id' => $keuzedeel->id,
            'type' => 'verwijdering',
            'title' => 'Inschrijving verwijderd',
            'message' => 'Je inschrijving voor het keuzedeel "' . $keuzedeel->naam . '" is verwijderd door een beheerder. Neem contact op met je docent als je vragen hebt.',
        ]);

        $keuzedeel->users()->detach($user->id);

        return back()->with('success', 'Inschrijving succesvol verwijderd!');
    }

    public function annuleerKeuzedeel(Keuzedeel $keuzedeel)
    {
        // Haal alle studenten op die zijn aangemeld voor dit keuzedeel
        $studenten = $keuzedeel->users()
            ->wherePivot('status', '!=', 'voltooid')
            ->get();

        foreach ($studenten as $student) {
            // Verwijder de inschrijving
            $keuzedeel->users()->detach($student->id);

            // Stuur notificatie
            Notification::create([
                'user_id' => $student->id,
                'keuzedeel_id' => null,
                'type' => 'afwijzing',
                'title' => 'Keuzedeel geannuleerd',
                'message' => 'Het keuzedeel "' . $keuzedeel->naam . '" is geannuleerd vanwege te weinig inschrijvingen. Meld je aan voor een nieuw keuzedeel.',
            ]);
        }

        return back()->with('success', 'Keuzedeel geannuleerd.');
    }
}
