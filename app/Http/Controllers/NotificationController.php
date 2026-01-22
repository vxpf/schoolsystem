<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->get();

        $user->notifications()->update(['is_read' => true]);

        return view('inbox.index', compact('notifications', 'user'));
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->update(['is_read' => true]);

        return back()->with('success', 'Bericht gemarkeerd als gelezen');
    }

    public function markAllAsRead()
    {
        Auth::user()->notifications()->update(['is_read' => true]);

        return back()->with('success', 'Alle berichten gemarkeerd als gelezen');
    }

    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Bericht verwijderd');
    }

    public function destroyAll()
    {
        Auth::user()->notifications()->delete();

        return redirect()->route('inbox.index')->with('success', 'Alle berichten verwijderd');
    }
}
