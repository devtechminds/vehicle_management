<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
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

       public static function getAllArea(){
           return Area::select('id','area')->get();
       }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function getLocation()
        {
        return $this->hasOne('App\Location', 'id', 'location_id');
        }


       public static function getAllAreaById($id){
        return Area::select('id','area')->where('id','=',$id)->get();
        }

}
