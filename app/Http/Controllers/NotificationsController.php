<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    public function unread()
    {
        return redirect()->route('notifications.index');
    }

    public function index()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        $notifications = $user->notifications;
        return view('messages.notifications', compact('notifications'));
    }

    public function messages()
    {
        return view('messages.message');
    }

}
