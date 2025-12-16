<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keuzedelen = Keuzedeel::where('actief', true)->get();
        $mijnKeuzedelen = $user->keuzedelen ?? collect();

        return view('dashboard', compact('user', 'keuzedelen', 'mijnKeuzedelen'));
    }
}
