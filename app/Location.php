<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
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

       public static function getAllLocation(){
           return Location::select('id','location')->get();
       }

}
