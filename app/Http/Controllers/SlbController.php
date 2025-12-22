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
}
