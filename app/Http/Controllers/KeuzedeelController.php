<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuzedeelController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keuzedelen = Keuzedeel::where('actief', true)
            ->withCount(['users as aanmeldingen_count'])
            ->get();
        
        $mijnKeuzedelen = $user->keuzedelen()->pluck('keuzedeel_id')->toArray();

        return view('keuzedelen.index', compact('keuzedelen', 'mijnKeuzedelen', 'user'));
    }

    public function show(Keuzedeel $keuzedeel)
    {
        $user = Auth::user();
        $enrollment = $user->keuzedelen()->where('keuzedeel_id', $keuzedeel->id)->first();
        $isAangemeld = $enrollment !== null;
        $enrollmentStatus = $enrollment ? $enrollment->pivot->status : null;
        $isVoltooid = $enrollmentStatus === 'voltooid';
        $aantalAanmeldingen = $keuzedeel->users()->count();

        return view('keuzedelen.show', compact('keuzedeel', 'isAangemeld', 'enrollmentStatus', 'isVoltooid', 'aantalAanmeldingen', 'user'));
    }

    public function aanmelden(Keuzedeel $keuzedeel)
    {
        $user = Auth::user();

        // Check of al aangemeld
        if ($user->keuzedelen()->where('keuzedeel_id', $keuzedeel->id)->exists()) {
            return back()->with('error', 'Je bent al aangemeld voor dit keuzedeel.');
        }

        // Check of keuzedeel al voltooid is
        $voltooideInschrijving = $user->keuzedelen()
            ->where('keuzedeel_id', $keuzedeel->id)
            ->wherePivot('status', 'voltooid')
            ->exists();
        
        if ($voltooideInschrijving) {
            return back()->with('error', 'Je hebt dit keuzedeel al voltooid en kunt je niet opnieuw inschrijven.');
        }

        // Check of keuzedeel vol is
        $aantalAanmeldingen = $keuzedeel->users()->count();
        if ($aantalAanmeldingen >= $keuzedeel->max_studenten) {
            return back()->with('error', 'Dit keuzedeel is vol. Probeer een ander keuzedeel.');
        }

        // Aanmelden
        $user->keuzedelen()->attach($keuzedeel->id, ['status' => 'aangemeld']);

        return back()->with('success', 'Je bent succesvol aangemeld voor ' . $keuzedeel->naam . '!');
    }

    public function afmelden(Keuzedeel $keuzedeel)
    {
        $user = Auth::user();

        // Check of aangemeld
        if (!$user->keuzedelen()->where('keuzedeel_id', $keuzedeel->id)->exists()) {
            return back()->with('error', 'Je bent niet aangemeld voor dit keuzedeel.');
        }

        // Afmelden
        $user->keuzedelen()->detach($keuzedeel->id);

        return back()->with('success', 'Je bent afgemeld voor ' . $keuzedeel->naam . '.');
    }

    public function mijnKeuzedelen()
    {
        $user = Auth::user();
        $keuzedelen = $user->keuzedelen()->get();

        return view('keuzedelen.mijn', compact('keuzedelen', 'user'));
    }
}
