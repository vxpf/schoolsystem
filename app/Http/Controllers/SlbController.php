<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlbController extends Controller
{
    public function dashboard()
    {
        $totalKeuzedelen = Keuzedeel::where('actief', true)->count();
        $totalStudents = User::where('role', 'student')->count();
        $totalEnrollments = DB::table('keuzedeel_user')->count();
        
        $keuzedelen = Keuzedeel::where('actief', true)
            ->withCount('users')
            ->orderBy('naam')
            ->get();

        return view('slb.dashboard', compact('totalKeuzedelen', 'totalStudents', 'totalEnrollments', 'keuzedelen'));
    }

    public function presentatie()
    {
        $keuzedelen = Keuzedeel::where('actief', true)
            ->withCount('users')
            ->orderBy('naam')
            ->get();

        return view('slb.presentatie', compact('keuzedelen'));
    }

    public function keuzedeelSlide(Keuzedeel $keuzedeel)
    {
        $keuzedeel->loadCount('users');
        $ingeschrevenStudenten = $keuzedeel->users()->get();
        
        return view('slb.keuzedeel-slide', compact('keuzedeel', 'ingeschrevenStudenten'));
    }

    public function cijfers()
    {
        // Haal alle studenten op met al hun keuzedelen
        $studenten = User::where('role', 'student')
            ->with(['keuzedelen' => function($query) {
                $query->orderBy('naam');
            }])
            ->orderBy('name')
            ->get()
            ->filter(function($student) {
                return $student->keuzedelen->count() > 0;
            });

        return view('slb.cijfers', compact('studenten'));
    }

    public function updateCijfer(Request $request, Keuzedeel $keuzedeel, User $user)
    {
        $validated = $request->validate([
            'cijfer' => 'required|numeric|min:1|max:10'
        ]);

        // Check of het keuzedeel voltooid is
        $enrollment = $keuzedeel->users()->where('user_id', $user->id)->first();
        if (!$enrollment || $enrollment->pivot->status !== 'voltooid') {
            return back()->with('error', 'Je kunt alleen cijfers geven aan voltooide keuzedelen.');
        }

        $keuzedeel->users()->updateExistingPivot($user->id, [
            'cijfer' => $validated['cijfer']
        ]);

        // Stuur notificatie naar student
        \App\Models\Notification::create([
            'user_id' => $user->id,
            'keuzedeel_id' => $keuzedeel->id,
            'type' => 'cijfer',
            'title' => 'Cijfer ontvangen',
            'message' => 'Je hebt een cijfer ontvangen voor het keuzedeel "' . $keuzedeel->naam . '": ' . number_format($validated['cijfer'], 1),
        ]);

        return back()->with('success', 'Cijfer succesvol bijgewerkt en student is op de hoogte gesteld!');
    }
}
