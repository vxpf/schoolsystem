<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keuzedeel;
use App\Models\Notification;
use Illuminate\Http\Request;

class KeuzedeelCrudController extends Controller
{
    public function index()
    {
        $keuzedelen = Keuzedeel::withCount('users')
            ->orderBy('naam')
            ->get();

        return view('admin.keuzedelen.index', compact('keuzedelen'));
    }

    public function create()
    {
        return view('admin.keuzedelen.create');
    }

    public function store(Request $request)
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

    public function edit(Keuzedeel $keuzedeel)
    {
        return view('admin.keuzedelen.edit', compact('keuzedeel'));
    }

    public function update(Request $request, Keuzedeel $keuzedeel)
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

        $oudeNaam = $keuzedeel->naam;
        $wasActief = $keuzedeel->actief;

        $validated['actief'] = $request->has('actief');

        $keuzedeel->update($validated);

        $ingeschrevenStudenten = $keuzedeel->users()
            ->wherePivot('status', '!=', 'voltooid')
            ->get();

        if ($ingeschrevenStudenten->count() > 0) {
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
            } else {
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

    public function destroy(Keuzedeel $keuzedeel)
    {
        $enrollmentCount = $keuzedeel->users()->count();
        
        if ($enrollmentCount > 0) {
            return back()->with('error', 'Kan keuzedeel niet verwijderen. Er zijn nog ' . $enrollmentCount . ' studenten ingeschreven.');
        }

        $keuzedeel->delete();

        return redirect()->route('admin.keuzedelen.index')
            ->with('success', 'Keuzedeel succesvol verwijderd!');
    }

    public function annuleer(Keuzedeel $keuzedeel)
    {
        $studenten = $keuzedeel->users()
            ->wherePivot('status', '!=', 'voltooid')
            ->get();

        foreach ($studenten as $student) {
            $keuzedeel->users()->detach($student->id);

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
