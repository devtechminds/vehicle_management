<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customers extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'customer_code',
        'customer_name',
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

    public static function getAllCustomers(){
        return  Customers::select('customer_code','customer_name')->where('status','=','1')->get()->toArray();
      } 
}