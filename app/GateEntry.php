<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\MeManifestoEntry;
use App\ReleaseApprovalFinacialOfficerEntry;
use App\UploadDocuments;
use App\GateEntryOut;


class GateEntry extends Model
{
    public static function getGateEntryNo(){
        $last_row = DB::table('gate_entries')->select('id')->orderBy('id', 'DESC')->first();
        if($last_row){
            $id=$last_row->id+1;
            return "CSF/MG-IN/".date('Y')."/".$id;
        }else{
            return "CSF/MG-IN/".date('Y')."/1";
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

        public static function gateEntryOfficerData(){
            $data['total']= ManifestoEntry::where('status','=',2)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
            $data['proceed_vehicle']= GateEntry::where('status','=',1)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
            $data['container_out_registered']= ReleaseApprovalFinacialOfficerEntry::where('status','=',2)->whereDate('created_at', '=', date('Y-m-d'))->count();
            $data['total_cfs_out']= GateEntryOut::where('status','=',1)->whereDate('created_at', '=', date('Y-m-d'))->count();  
            return $data;
       }

        public static function getCFSOfficerData(){
        $data['authorize_vehicle_in']= GateEntry::where('status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
        $data['authorize_vehicle_return']= UploadDocuments::where('status','=',1)->whereDate('created_at', '=', date('Y-m-d'))->count();
        $data['gatepass_printed']= UploadDocuments::where('status','=',3)->whereDate('created_at', '=', date('Y-m-d'))->count();  
        $data['authorize_container_out']= GateEntryOut::where('status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
        $data['proceed_container_out']= WeightBridgeEntryOut::where('status','=',1)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
        $data['outpass_printed']= WeightBridgeEntryOut::where('status','=',3)->whereDate('created_at', '=', date('Y-m-d'))->count();     
        return $data;
        }
        public static function getWeighBridgeOfficerData(){
        $data['weigh_bridge_entry']= GateEntry::where('status','=',2)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
        $data['weigh_bridge_exit']= UploadDocuments::where('status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count();
        $data['container_out_weigh_bridge_entry']= GateEntryOut::where('status','=',1)->whereDate('created_at', '=', date('Y-m-d'))->count();  
        $data['container_out_weigh_bridge_exit']= WeightBridgeEntryOut::where('status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
        return $data;
        }

        public static function getFieldSupervisorData(){
            $data['document_uploaded']= WeighBridge::where('status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
            $data['container_stuffing']= UploadDocuments::where('out_process_status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count();
            return $data;
            }
     
        public static function getCFSOperationManagerData(){
            $data['authorize_vehicle_in']= GateEntry::where('status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
            $data['proceed_vehicle']= GateEntry::where('status','=',1)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
            $data['container_out_weigh_bridge_exit']= WeightBridgeEntryOut::where('status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
            $data['total_cfs_out']= GateEntryOut::where('status','=',1)->whereDate('created_at', '=', date('Y-m-d'))->count();  
            $data['weigh_bridge_entry']= GateEntry::where('status','=',2)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
            return$data;
        }     
        public static function getFinanceControllerData(){
            $data['tokens_generated']= ReleaseApprovalFinacialOfficerEntry::where('status','=',0)->whereDate('created_at', '=', date('Y-m-d'))->count();
            $data['expired_tokens']= ReleaseApprovalFinacialOfficerEntry::where('status','=',2)->whereDate('created_at', '=', date('Y-m-d'))->count();
            return $data;
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function weighBridges()
        {
            return $this->hasOne('App\WeighBridge', 'gate_entry_id', 'id');
        }
    
}
