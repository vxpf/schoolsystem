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
}
