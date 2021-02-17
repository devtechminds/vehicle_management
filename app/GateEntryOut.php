<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class GateEntryOut extends Model
{
    public static function getGateEntryNo(){
        $last_row = DB::table('gate_entry_outs')->select('id')->orderBy('id', 'DESC')->first();
        if($last_row){
            $id=$last_row->id+1;
            return "CSF/MG-OUT/".date('Y')."/".$id;
        }else{
            return "CSF/MG-OUT/".date('Y')."/1";
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
        return $this->hasOne('App\ReleaseApprovalFinacialOfficerEntry', 'id', 'release_approval_finacial_officer_entries_id');
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function getFieldSupervisorEntryOut()
        {
        return $this->hasOne('App\FieldSupervisorEntryOut', 'id', 'field_supervisor_entry_out_id');
        }

                /**
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function getGateEntryIn()
        {
        return $this->hasOne('App\GateEntry', 'id', 'gate_entry_id_in');
        }
}
