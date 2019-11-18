<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // 読み込むパス
    const READ_IMG_PATH = "storage/photos/";
    // 保存されるパス
    const SAVE_IMG_PATH = "public/photos/";
    // 一時保存されるパス
    const SAVE_TEMP_PATH = "public/temp/photos/";

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function getPhoto($photo_id)
    {
        return $this->with('user')->where('id', $photo_id)->first();
    }

    public function getUrlAttribute()
    {
        return asset(self::READ_IMG_PATH . $this->filename);
    }

    public function getPathAttribute()
    {
        return self::READ_IMG_PATH . $this->filename;
    }
}
