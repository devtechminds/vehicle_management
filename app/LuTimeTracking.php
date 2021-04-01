<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuTimeTracking extends Model
{
    public function getLuGateEntry()
    {
        return $this->hasOne('App\LuGateEntrie', 'id', 'lu_gate_entry_id');
    }
}
