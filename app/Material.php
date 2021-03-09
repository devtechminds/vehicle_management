<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Material extends Model
{
    use SoftDeletes;

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
    public function getUOM()
    {
        return $this->hasOne('App\UOM', 'id', 'uom_id');
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getCommodity()
    {
    return $this->hasOne('App\Commodity', 'commodity_code', 'commodity_id');
    }

    public static function getAllMaterial(){
        return  Material::select('id','material_name')->where('status','=','1')->get()->toArray();
      } 

      public static function getAllMaterialData(){
        return  Material::select('id','material_name','unit_weight')->where('status','=','1')->get()->toArray();
      } 
   
}
