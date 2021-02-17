<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Consignment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'consignment_type',
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


  public static function getAllConsignment(){
    return  Consignment::select('id','consignment_type')->where('status','=','1')->get()->toArray();
 
}
}
