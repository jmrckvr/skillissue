<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read');
    }

    public function markAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications()->update(['read_at' => now()]);
        return back()->with('success', 'All notifications marked as read');
    }
}
