<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuCommodityDetail extends Model
{
    public function getMaterial()
    {
        return $this->hasOne('App\Material', 'id', 'material');
    }

    public function getUOM()
    {
        return $this->hasOne('App\UOM', 'id', 'uom');
    }
}
