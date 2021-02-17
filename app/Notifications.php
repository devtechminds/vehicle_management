<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notifications extends Model
{
    public static function sendNotification($sender_type,$receiver_type,$title='',$message='',$url='')
	{
        $notifications = new Notifications();
        $notifications->sender_type = $sender_type;
        $notifications->receiver_type = $receiver_type;
        $notifications->title = $title;
        $notifications->message = $message;
        $notifications->url = $url;
        $notifications->save();
        return 1;
    }


    public static function getNotification($is_read=0)
	{
      
        $user_type = explode(",",Auth::user()->user_type);
        return Notifications::whereIn('receiver_type',$user_type)->where('is_read',$is_read)->get();
    }

    public function time_elapsed_string($datetime, $full = false) {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
