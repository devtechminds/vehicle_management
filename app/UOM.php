<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UOM extends Model
{
    
  protected $fillable = [
    'unit_entry_filed',
    'status',
    'created_by',
    'updated_by',
    'created_at',
    'updated_at'
];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'uom';


  public static function getAllUOM(){
       return  UOM::select('id','unit_entry_filed')->get()->toArray();
    
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

    
 

}
