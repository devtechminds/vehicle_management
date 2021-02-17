<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadDocuments extends Model
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
   
   
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getGateEntry()
    {
        return $this->hasOne('App\GateEntry', 'id', 'gate_entry_id');
    }

      /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getManifestoEntry()
    {
        return $this->hasOne('App\ManifestoEntry', 'id', 'manifesto_entry_id');
    }

    /** * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function getConsignmentDetails()
    {
    return $this->hasOne('App\ConsignmentDetails', 'id', 'consignment_details_id');
    }

    /** * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function getWeighBridge()
    {
    return $this->hasOne('App\WeighBridge', 'id', 'weigh_bridges_id');
    }

     /** * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function getLocation()
    {
    return $this->hasOne('App\Location', 'id', 'location');
    }

     /** * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function getArea()
    {
    return $this->hasOne('App\Area', 'id', 'area_id');
    }
    
    /** * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function getBin()
    {
    return $this->hasOne('App\Bin', 'id', 'bin_id');
    }
    

      /** * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function getUploadDocumentsFiles()
    {
    return $this->hasOne('App\UploadDocumentsFiles', 'upload_documents_id', 'id');
    }

     /** * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function getAllUploadDocumentsFiles()
    {
    return $this->hasMany('App\UploadDocumentsFiles', 'upload_documents_id', 'id');
    }

}
