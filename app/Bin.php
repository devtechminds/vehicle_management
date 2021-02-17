<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bin extends Model
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
       /**
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function getLocation()
        {
        return $this->hasOne('App\Location', 'id', 'location_id');
        }
         /**
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function getArea()
        {
        return $this->hasOne('App\Area', 'id', 'area_id');
        }
        public static function getAllBinById($id){
          return Bin::select('id','bin')->where('id','=',$id)->get();
          }
}
