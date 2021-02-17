<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Commodity extends Model
{
     use SoftDeletes;
    protected $fillable = [
        'commodity_code',
        'commodity_name',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];


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

    public static function getCommodity(){
        return  Commodity::select('commodity_code','commodity_name')->get()->toArray();
     
   }


   
}
