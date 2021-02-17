<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
/**
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

     /**
     * Get the EtcAgent.
     *
     * @param  string $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i:s', strtotime($value));
    }

    public static function AddLog($message)
	{
        $UserLog = new UserLog();
        $UserLog->user_id = auth()->user()->id;
        $UserLog->message = $message.' '.auth()->user()->name;
        $UserLog->created_at = now();
        $UserLog->updated_at = now();
        $UserLog->save();
        return 1;
    }


}
