<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class LuGateEntrie extends Model
{
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i:s', strtotime($value));
    }

    public static function getRefNo(){
        $last_row = DB::table('lu_gate_entries')->select('id')->orderBy('id', 'DESC')->first();
        if($last_row){
            $id =$last_row->id+1;
            return "LOD/G/".date('Y')."/".$id;
        }else{
            return "LOD/G/".date('Y')."/1";
        }
        
    }

    public static function getGatePassNo(){
        $last_row = DB::table('lu_gate_entries')->select('id')->orderBy('id', 'DESC')->first();
        if($last_row){
            $id =$last_row->id+1;
            return "LOD/GP-OUT/".date('Y')."/".$id;
        }else{
            return "LOD/GP-OUT/".date('Y')."/1";
        }
        
    }

    public function getCustomer()
    {
        return $this->hasOne('App\Customers', 'customer_code', 'customer_name');
    }

    public function getCommodity()
    {
        return $this->hasOne('App\Commodity', 'commodity_code', 'commodity');
    }

    public function getTransporter()
    {
        return $this->hasOne('App\Transports', 'transport_code', 'transporter');
    }

    public function getLuCommodityDetail()
    {
        return $this->hasMany('App\LuCommodityDetail', 'lu_gate_entry_id', 'id');
    }

    public function getLuWeightBridge()
    {
        return $this->hasOne('App\LuWeightBridge', 'lu_gate_entry_id', 'id');
    }

    public static function getLoadingDashboardData(){
        $data['loading_count']= LuGateEntrie::where('status','=',2)->where('out_process_status','=',2)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
        $data['unloading_count']= LuGateEntrie::where('status','=',2)->where('out_process_status','=',2)->whereDate('created_at', '=', date('Y-m-d'))->count(); 
        return$data;
    } 
}
