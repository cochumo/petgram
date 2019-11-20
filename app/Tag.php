<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['id', 'name'];

    public function photos()
    {
        return $this->belongsToMany('App\photo', 'photo_tags', 'tag_id', 'photo_id');
    }
}
