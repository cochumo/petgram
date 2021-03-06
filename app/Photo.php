<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableContract;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;

class Photo extends Model implements ReactableContract
{
    use Reactable;

    // 読み込むパス
    const READ_IMG_PATH = "storage/photos/";
    // 保存されるパス
    const SAVE_IMG_PATH = "public/photos/";
    // 一時保存されるパス
    const SAVE_TEMP_PATH = "public/temp/photos/";

    protected $fillable = ['id', 'user_id', 'filename', 'message'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'photo_tags', 'photo_id', 'tag_id');
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
