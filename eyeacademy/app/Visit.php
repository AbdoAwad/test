<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'patient_id',
        'out_time'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function tracks()
    {
        return $this->hasMany('App\Track');
    }
}
