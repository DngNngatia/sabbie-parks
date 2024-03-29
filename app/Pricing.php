<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $fillable = ['parking_spot_id', 'cost_price'];

    public function parking_spot(){
        return $this->belongsTo(ParkingSpot::class);
    }
}
