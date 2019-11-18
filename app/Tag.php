<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function photo()
    {
        return $this->belongsToMany('App\photo');
    }
}
