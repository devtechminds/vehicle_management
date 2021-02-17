<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class ManifestoEntry extends Model
{
    //


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
    public function getConsignment()
    {
        return $this->hasOne('App\Consignment', 'id', 'consignment_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getCargo()
    {
        return $this->hasOne('App\Cargo', 'cargo_code', 'cargo_type');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getCustomers()
    {
        return $this->hasOne('App\Customers', 'customer_code', 'customer_name');
    }


      /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getAgent()
    {
        return $this->hasOne('App\EtcAgent', 'agent_code', 'cf_agent');
    }


    /** * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function getConsignmentDetails()
   {
       return $this->hasMany('App\ConsignmentDetails', 'manifesto_entry_id', 'id');
   }

   
   public static function getRefNo(){
    $last_row = DB::table('manifesto_entries')->select('id')->orderBy('id', 'DESC')->first();
    if($last_row){
        $id =$last_row->id+1;
        return "CFS/M/".date('Y')."/".$id;
    }else{
        return "CFS/M/".date('Y')."/1";
    }
    
   }

   public static function getGatePassNo(){
    $last_row = DB::table('manifesto_entries')->select('id')->orderBy('id', 'DESC')->first();
    if($last_row){
        $id =$last_row->id+1;
        return "CFS/MGP-IN/".date('Y')."/".$id;
    }else{
        return "CFS/MGP-IN/".date('Y')."/1";
    }
    
   }

   public static function getGatePassNoOut(){
    $last_row = DB::table('manifesto_entries')->select('id')->orderBy('id', 'DESC')->first();
    if($last_row){
        $id =$last_row->id+1;
        return "CFS/MGP-OUT/".date('Y')."/".$id;
    }else{
        return "CFS/MGP-OUT/".date('Y')."/1";
    }
    
   }

   public static function getAllRefNo(){
   
    return ManifestoEntry::select('id','ref_no')->get()->toArray();
    
   }

   public static function ManifestoEntryCount(){
      $data['total']= ManifestoEntry::count();
      $data['pending']= ManifestoEntry::where('status','=',0)->count();
      $data['approve']= ManifestoEntry::where('status','=',2)->orWhere('status','=',3)->count();
      $data['reject']= ManifestoEntry::where('status','=',10)->count();
     return $data;

   }
      /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getReleaseApprovalFinacialOfficerEntry()
    {
        return $this->hasOne('App\ReleaseApprovalFinacialOfficerEntry', 'manifesto_entry_id', 'id');
    }
   

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUploadDocuments()
    {
        return $this->hasOne('App\UploadDocuments', 'manifesto_entry_id', 'id');
    }
}
