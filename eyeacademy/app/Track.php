<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'visit_id',
        'station_id',
        'feedback',
        'out_time'
    ];

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }

    public function station()
    {
        return $this->belongsTo('App\Station');
    }
}
