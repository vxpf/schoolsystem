<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $keuzedelen = $user->keuzedelen()->withPivot('status')->get();
        
        return view('profile.show', compact('user', 'keuzedelen'));
    }
}
