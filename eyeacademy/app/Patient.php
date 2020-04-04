<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'file_number'
    ];

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }
}
