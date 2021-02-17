<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsignmentDetails extends Model
{
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getCommodity()
    {
        return $this->hasOne('App\Commodity', 'commodity_code', 'commodity');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getMaterial()
    {
        return $this->hasOne('App\Material', 'id', 'material');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getTransports()
    {
        return $this->hasOne('App\Transports', 'transport_code', 'transporter');
    }


     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUOM()
    {
        return $this->hasOne('App\UOM', 'id', 'uom');
    }

    public static function getGateEntryNo($id){
      $data['total']= ConsignmentDetails::where('manifesto_entry_id','=',$id)->count(); 
      $data['pending']= ConsignmentDetails::where(['manifesto_entry_id' =>$id,'status'=>0])->count();
      return $data;
    }

    public static function getAllTransporter(){
        return  ConsignmentDetails::select('transporter')->distinct('transporter')->where('transporter','!=','')->get()->toArray();
     
   }


}
