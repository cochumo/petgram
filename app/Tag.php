<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function photos()
    {
        return $this->belongsToMany('App\photo');
    }
}
