<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
        'name', 'email', 'password',
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

    public function getUrlAttribute()
    {
        return asset(self::READ_IMG_PATH . $this->filename);
    }
}
