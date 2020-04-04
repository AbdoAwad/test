<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = [
        'name',
        'image',
        'background',
        'warning_time',
        'staff_id',
        'dangerous_time'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tracks()
    {
        return $this->hasMany('App\Track');
    }

    public function getImageAttribute(){
        return url("uploads/".$this->attributes['image']);
    }
}
