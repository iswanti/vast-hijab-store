<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    // USER
    public function index()
{
    Notification::where(
        'user_id',
        auth()->id()
    )->where(
        'is_read',
        false
    )->update([
        'is_read' => true
    ]);

    $notifications = Notification::where(
        'user_id',
        auth()->id()
    )
    ->latest()
    ->paginate(10);

    return view(
        'user.notifications',
        compact('notifications')
    );
}

    // ADMIN
    public function admin()
    {
     Notification::where(
        'role',
        'admin'
    )->where(
        'is_read',
        false
    )->update([
        'is_read' => true
    ]);

    $notifications = Notification::where(
        'role',
        'admin'
    )
    ->latest()
    ->get();

    return view(
        'admin.notifications',
        compact('notifications')
    );
    }
}
