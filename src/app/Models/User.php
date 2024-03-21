<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // 中間テーブルのリレーション
    public function favorites()
    {
        return $this->belongsToMany(Shop::class, 'favorites', 'user_id', 'shop_id');
    }


    // // この店に対してお気に入りのレコードが存在するか確認
    // public function is_favorite($userId)
    // {
    //     return $this->favorites()->where('user_id', $userId)->exists();
    // }

    // いいね追加
    public function favorite($userId)
    {
        // もしいいねがあれば、
        // if($this->is_favorite($userId)){
        //     // 何もしない
        // } else {
        //     // 中間テーブルのfavoritesテーブルに追加する
            $this->favorites()->attach($userId);
        // }
    }

    // いいね削除
    public function unfavorite($userId)
    {
        // // もしいいねがあれば、
        // if($this->is_favorite($userId)){
        //     // 中間テーブルのfavoritesテーブルから削除する
            $this->favorites()->detach($userId);
        // } else {
        //     // 何もしない
        // }
    }
}
