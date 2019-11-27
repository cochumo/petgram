<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableContract;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;

class User extends Authenticatable implements ReacterableContract
{
    use Reacterable;

    // 読み込むパス
    const READ_IMG_PATH = "storage/thumbnail/";
    // 保存されるパス
    const SAVE_IMG_PATH = "public/thumbnail/";
    // 一時保存されるパス
    const SAVE_TEMP_PATH = 'public/temp/thumbnail/';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile', 'thumbnail',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function getUrlAttribute()
    {
        if ($this->thumbnail == "") {
            return asset('img/default_thumbnail.svg');
        }

        return asset(self::READ_IMG_PATH . $this->thumbnail);
    }
}
