<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
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

        return view('admin.dashboard', compact('totalStudents', 'totalKeuzedelen', 'totalEnrollments', 'activeKeuzedelen'));
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
            'code' => 'required|string|unique:keuzedelen,code',
            'studiepunten' => 'required|integer|min:0',
            'niveau' => 'nullable|string|max:255',
            'max_studenten' => 'required|integer|min:1',
            'actief' => 'boolean',
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
            'code' => 'required|string|unique:keuzedelen,code,' . $keuzedeel->id,
            'studiepunten' => 'required|integer|min:0',
            'niveau' => 'nullable|string|max:255',
            'max_studenten' => 'required|integer|min:1',
            'actief' => 'boolean',
        ]);

        $validated['actief'] = $request->has('actief');

        $keuzedeel->update($validated);

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
            'status' => 'required|in:aangemeld,goedgekeurd,afgewezen,voltooid'
        ]);

        $keuzedeel->users()->updateExistingPivot($user->id, [
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Status succesvol bijgewerkt!');
    }

    public function removeEnrollment(Keuzedeel $keuzedeel, User $user)
    {
        $keuzedeel->users()->detach($user->id);

        return back()->with('success', 'Inschrijving succesvol verwijderd!');
    }
}
