<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getPhoto($photo_id)
    {
        return $this->with('user')->where('id', $photo_id)->first();

    }
}
