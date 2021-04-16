<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldSupervisorEntryOut extends Model
{
     /**
     * Get the EtcAgent.
     *
     * @param  string $value
     * @return string
     */
    protected $append = ['created_at_print'];

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    public function getCreatedAtPrintAttribute()
    {
        return date('Y-m-d', strtotime($this->created_at));
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

    public function getArea()
    {
    return $this->hasOne('App\Area', 'id', 'area_id');
    }
}
