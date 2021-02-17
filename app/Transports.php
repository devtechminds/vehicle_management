<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transports extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transport_code',
        'transport_name',
        'tin_no',
        'vrn_np',
        'mobile_number',
        'email',
        'country',
        'province',
        'place',
        'pincode',
        'address',
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

    public static function getTransports(){
        return  Transports::select('transport_code','transport_name')->get()->toArray();
     
   }
}
