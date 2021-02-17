<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class WeightBridgeEntryOut extends Model
{
    public static function getWBTicketNo(){
        $last_row = DB::table('weight_bridge_entry_outs')->select('id')->orderBy('id', 'DESC')->first();
        if($last_row){
            return "CFS/W/".date('Y')."/".$last_row->id;
        }else{
            return "CFS/W/".date('Y')."/1";
        }
        
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

        public function getReleaseApprovalFinacialOfficerEntry()
        {
        return $this->hasOne('App\ReleaseApprovalFinacialOfficerEntry', 'id', 'finacial_officer_entry_id');
        }

        public function getGateEntryOut()
        {
        return $this->hasOne('App\GateEntryOut', 'id', 'gate_entry_out_id');
        }

        public function getFieldSupervisorEntryOut()
        {
        return $this->hasOne('App\FieldSupervisorEntryOut', 'id', 'weight_bridge_entry_outs_id');
        }

}
