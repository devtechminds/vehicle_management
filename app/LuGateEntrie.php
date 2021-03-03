<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class LuGateEntrie extends Model
{
    public static function getRefNo(){
        $last_row = DB::table('lu_gate_entries')->select('id')->orderBy('id', 'DESC')->first();
        if($last_row){
            $id =$last_row->id+1;
            return "LOD/G/".date('Y')."/".$id;
        }else{
            return "LOD/G/".date('Y')."/1";
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
}
