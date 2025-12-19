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

        return view('notifications.index', compact('notifications', 'user'));
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->update(['is_read' => true]);

        return back()->with('success', 'Notificatie gemarkeerd als gelezen');
    }

    public function markAllAsRead()
    {
        Auth::user()->notifications()->update(['is_read' => true]);

        return back()->with('success', 'Alle notificaties gemarkeerd als gelezen');
    }
}
