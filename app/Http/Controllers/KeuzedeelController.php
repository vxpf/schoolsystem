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
        
        // Haal de statussen op van de aangemelde keuzedelen
        $keuzedeelStatussen = $user->keuzedelen()
            ->get()
            ->pluck('pivot.status', 'id')
            ->toArray();

        return view('keuzedelen.index', compact('keuzedelen', 'mijnKeuzedelen', 'keuzedeelStatussen', 'user'));
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

        // Check of keuzedeel al voltooid is
        $enrollment = $user->keuzedelen()->where('keuzedeel_id', $keuzedeel->id)->first();
        
        if ($enrollment) {
            if ($enrollment->pivot->status === 'voltooid') {
                return back()->with('error', 'Je hebt dit keuzedeel al voltooid en kunt je niet opnieuw inschrijven.');
            }
            return back()->with('error', 'Je bent al aangemeld voor dit keuzedeel.');
        }

        // Check of student al een keuzedeel heeft voor deze periode (inclusief voltooide)
        $huidigePeriode = $user->huidige_periode;
        
        // Haal alle keuzedelen van de student op en filter op periode
        $alleKeuzedelen = $user->keuzedelen()->get();
        
        foreach ($alleKeuzedelen as $bestaandKeuzedeel) {
            // Als keuzedeel geen periode heeft, beschouw het als huidige periode
            $keuzedeelPeriode = $bestaandKeuzedeel->periode ?? $huidigePeriode;
            
            if ($keuzedeelPeriode === $huidigePeriode) {
                $status = $bestaandKeuzedeel->pivot->status;
                if ($status === 'voltooid') {
                    return back()->with('error', 'Je hebt al een keuzedeel voltooid in periode ' . $huidigePeriode . ' (' . $bestaandKeuzedeel->naam . '). Je kunt maar 1 keuzedeel per periode volgen.');
                } else {
                    return back()->with('error', 'Je bent al aangemeld voor een keuzedeel in periode ' . $huidigePeriode . ' (' . $bestaandKeuzedeel->naam . '). Je kunt maar 1 keuzedeel per periode volgen.');
                }
            }
        }

        // Check of keuzedeel in de juiste periode is
        $keuzedeelPeriode = $keuzedeel->periode ?? $huidigePeriode;
        if ($keuzedeelPeriode !== $huidigePeriode) {
            return back()->with('error', 'Dit keuzedeel is voor periode ' . $keuzedeelPeriode . ', maar jij zit in periode ' . $huidigePeriode . '.');
        }

        // Check of keuzedeel vol is
        $aantalAanmeldingen = $keuzedeel->users()->count();
        if ($aantalAanmeldingen >= $keuzedeel->max_studenten) {
            return back()->with('error', 'Dit keuzedeel is vol. Probeer een ander keuzedeel.');
        }

        // Aanmelden
        $user->keuzedelen()->attach($keuzedeel->id, [
            'status' => 'aangemeld'
        ]);

        $successMessage = '🎉 Gelukt! Je bent succesvol aangemeld voor het keuzedeel "' . $keuzedeel->naam . '" (periode ' . $huidigePeriode . '). Je ontvangt een bevestiging zodra je aanmelding is goedgekeurd door de docent.';
        
        return back()->with('success', $successMessage);
    }

    public function afmelden(Keuzedeel $keuzedeel)
    {
        $user = Auth::user();

        // Check of aangemeld
        $enrollment = $user->keuzedelen()->where('keuzedeel_id', $keuzedeel->id)->first();
        
        if (!$enrollment) {
            return back()->with('error', 'Je bent niet aangemeld voor dit keuzedeel.');
        }

        // Check of keuzedeel voltooid of afgewezen is
        if ($enrollment->pivot->status === 'voltooid') {
            return back()->with('error', 'Je kunt je niet afmelden voor een voltooid keuzedeel.');
        }

        if ($enrollment->pivot->status === 'afgewezen') {
            return back()->with('error', 'Je kunt je niet afmelden voor een afgewezen keuzedeel. Neem contact op met je docent.');
        }

        // Afmelden (alleen voor aangemeld en goedgekeurd)
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
