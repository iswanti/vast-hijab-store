<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // TAMPIL USER
    public function index()
    {
        $users = User::where('role', 'user')->get();

        return view('superadmin.user.index',
            compact('users'));

         $notifications = Notification::where(
        'user_id',
        auth()->id()
    )
    ->latest()
    ->get();

    return view(
        'user.notifications',
        compact('notifications')
    );
    
    }

    // DELETE USER
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/data-user')
            ->with('success', 'User berhasil dihapus');
    }

    
}
