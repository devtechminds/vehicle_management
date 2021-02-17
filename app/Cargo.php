<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cargo extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'cargo_code',
        'cargo_name',
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

  public static function getAllCargo(){
    return  Cargo::select('cargo_code','cargo_name')->where('status','=','1')->get()->toArray();
  } 

  public  static function getCargoTypeByType($type)
  {
         $cargo_types = Cargo::select('cargo_code','cargo_name')->where('type',strtolower($type))->get()->toArray();
         return $cargo_types;
  } 
}
