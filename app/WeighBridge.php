<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class WeighBridge extends Model
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
  
 
  
    public static function getWBTicketNo(){
        $last_row = DB::table('weigh_bridges')->select('id')->orderBy('id', 'DESC')->first();
        if($last_row){
            return "CFS/W/".date('Y')."/".$last_row->id;
        }else{
            return "CFS/W/".date('Y')."/1";
        }
        
       }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getManifestoEntry()
    {
    return $this->hasOne('App\ManifestoEntry', 'id', 'manifesto_entry_id');
    }

      /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getConsignmentDetails()
    {
    return $this->hasOne('App\ConsignmentDetails', 'id', 'consignment_details_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getGateEntry()
    {
    return $this->hasOne('App\GateEntry', 'id', 'gate_entry_id');
    }
}
