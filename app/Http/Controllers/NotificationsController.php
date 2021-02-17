<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications;

class NotificationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateNotification(Request $request)
    {
        $notification_id = $request->notification_id;
        if($request->ajax()){
            Notifications::where('id',$notification_id)->update(['is_read'=>1]);
        }
        return true;
    }
}
