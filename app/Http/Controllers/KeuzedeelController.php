<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuzedeelController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Keuzedeel::where('actief', true);
        
        if ($request->filled('niveau')) {
            $query->where('niveau', $request->niveau);
        }
        
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }
        
        if ($request->filled('studiepunten')) {
            $query->where('studiepunten', $request->studiepunten);
        }
        
        if ($request->filled('beschikbaarheid')) {
            if ($request->beschikbaarheid === 'beschikbaar') {
                $query->whereRaw('(SELECT COUNT(*) FROM keuzedeel_user WHERE keuzedeel_id = keuzedelen.id) < max_studenten');
            } elseif ($request->beschikbaarheid === 'vol') {
                $query->whereRaw('(SELECT COUNT(*) FROM keuzedeel_user WHERE keuzedeel_id = keuzedelen.id) >= max_studenten');
            }
        }
        
        $keuzedelen = $query->withCount(['users as aanmeldingen_count'])->get();
        
        $mijnKeuzedelen = $user->keuzedelen()->pluck('keuzedeel_id')->toArray();
        
        $keuzedeelStatussen = $user->keuzedelen()
            ->get()
            ->pluck('pivot.status', 'id')
            ->toArray();
        
        $niveaus = Keuzedeel::where('actief', true)->distinct()->pluck('niveau')->filter()->sort()->values();
        $periodes = Keuzedeel::where('actief', true)->distinct()->pluck('periode')->filter()->sort()->values();
        $studiepuntenOpties = Keuzedeel::where('actief', true)->distinct()->pluck('studiepunten')->filter()->sort()->values();

        return view('keuzedelen.index', compact('keuzedelen', 'mijnKeuzedelen', 'keuzedeelStatussen', 'user', 'niveaus', 'periodes', 'studiepuntenOpties'));
    }

    public function show(Keuzedeel $keuzedeel)
    {
        $user = Auth::user();
        $enrollment = $user->keuzedelen()->where('keuzedeel_id', $keuzedeel->id)->first();
        $isAangemeld = $enrollment !== null;
        $enrollmentStatus = $enrollment ? $enrollment->pivot->status : null;
        $isVoltooid = $enrollmentStatus === 'voltooid';
        $aantalAanmeldingen = $keuzedeel->users()->count();
        $isVol = $aantalAanmeldingen >= $keuzedeel->max_studenten;

        // Haal alternatieve keuzedelen op als dit keuzedeel vol is
        $alternatieven = collect();
        if (($isVol && !$isAangemeld) || $enrollmentStatus === 'afgewezen') {
            $huidigePeriode = $user->huidige_periode;
            $keuzedeelPeriode = $keuzedeel->periode ?? $huidigePeriode;
            
            // Haal keuzedelen op die:
            // - Actief zijn
            // - In dezelfde periode zijn
            // - Niet vol zijn
            // - Niet het huidige keuzedeel zijn
            // - Student is niet al aangemeld
            $mijnKeuzedeelIds = $user->keuzedelen()->pluck('keuzedeel_id')->toArray();
            
            $alternatieven = Keuzedeel::where('actief', true)
                ->where('id', '!=', $keuzedeel->id)
                ->whereNotIn('id', $mijnKeuzedeelIds)
                ->withCount(['users as aanmeldingen_count'])
                ->get()
                ->filter(function($alt) use ($keuzedeelPeriode) {
                    $altPeriode = $alt->periode ?? $keuzedeelPeriode;
                    return $altPeriode === $keuzedeelPeriode;
                })
                ->filter(function($alt) {
                    return $alt->aanmeldingen_count < $alt->max_studenten;
                })
                ->take(3);
        }

        return view('keuzedelen.show', compact('keuzedeel', 'isAangemeld', 'enrollmentStatus', 'isVoltooid', 'aantalAanmeldingen', 'isVol', 'alternatieven', 'user'));
    }

    public function aanmelden(Request $request, Keuzedeel $keuzedeel)
    {
        $user = Auth::user();

        // Check if student's opleiding matches keuzedeel's opleiding
        if ($keuzedeel->opleiding && $keuzedeel->opleiding !== $user->opleiding) {
            return back()->with('error', 'Dit keuzedeel is alleen beschikbaar voor studenten van de opleiding "' . $keuzedeel->opleiding . '". Jij bent ingeschreven voor "' . $user->opleiding . '".');
        }

        $enrollment = $user->keuzedelen()->where('keuzedeel_id', $keuzedeel->id)->first();
        
        if ($enrollment) {
            if ($enrollment->pivot->status === 'voltooid') {
                return back()->with('error', 'Je hebt dit keuzedeel al voltooid en kunt je niet opnieuw inschrijven.');
            }
            return back()->with('error', 'Je bent al aangemeld voor dit keuzedeel.');
        }

        $huidigePeriode = $user->huidige_periode;
        
        $alleKeuzedelen = $user->keuzedelen()->get();
        
        foreach ($alleKeuzedelen as $bestaandKeuzedeel) {
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

        $keuzedeelPeriode = $keuzedeel->periode ?? $huidigePeriode;
        if ($keuzedeelPeriode !== $huidigePeriode) {
            return back()->with('error', 'Dit keuzedeel is voor periode ' . $keuzedeelPeriode . ', maar jij zit in periode ' . $huidigePeriode . '.');
        }

        $aantalAanmeldingen = $keuzedeel->users()->count();
        if ($aantalAanmeldingen >= $keuzedeel->max_studenten) {
            return back()->with('error', 'Dit keuzedeel is vol. Probeer een ander keuzedeel.');
        }

        $beschikbarePlaatsen = $keuzedeel->max_studenten - $aantalAanmeldingen;
        if ($beschikbarePlaatsen < $keuzedeel->min_studenten) {
            return back()->with('error', 'Dit keuzedeel kan het minimum aantal van ' . $keuzedeel->min_studenten . ' studenten niet bereiken. Er zijn nog maar ' . $beschikbarePlaatsen . ' plaatsen beschikbaar.');
        }

        $user->keuzedelen()->attach($keuzedeel->id, [
            'status' => 'aangemeld'
        ]);

        $successMessage = 'Gelukt! Je bent succesvol aangemeld voor het keuzedeel "' . $keuzedeel->naam . '" (periode ' . $huidigePeriode . '). Je ontvangt een bevestiging zodra je aanmelding is goedgekeurd door de docent.';
        
        return back()->with('success', $successMessage);
    }

    public function afmelden(Keuzedeel $keuzedeel)
    {
        $user = Auth::user();

        $enrollment = $user->keuzedelen()->where('keuzedeel_id', $keuzedeel->id)->first();
        
        if (!$enrollment) {
            return back()->with('error', 'Je bent niet aangemeld voor dit keuzedeel.');
        }

        if ($enrollment->pivot->status === 'voltooid') {
            return back()->with('error', 'Je kunt je niet afmelden voor een voltooid keuzedeel.');
        }

        if ($enrollment->pivot->status === 'afgewezen') {
            return back()->with('error', 'Je kunt je niet afmelden voor een afgewezen keuzedeel. Neem contact op met je docent.');
        }

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
