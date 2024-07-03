<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function redirect($id)
    {
        $user = Auth::user();
        $notification = $user->notifications->find($id);

        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['url']);
        }

        return redirect()->back()->with('error', 'Notification Not Found');
    }
}