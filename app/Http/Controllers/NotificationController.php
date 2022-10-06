<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index(Request $request){
        $notifications = Notification::whereUserId(auth()->id())->latest()->paginate(5);
        return view('notification.index', compact('notifications'));
    }
    public function markAsRead(Request $request, Notification $notification){
        $notification->update(['read_at' => now()]);

        $redirectLink = $notification->redirect_link;

        if ($redirectLink == '#' || $redirectLink == '') {
            return back();
        }

        return redirect()->to($redirectLink);
    }

}
