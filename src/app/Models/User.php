<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

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

    public function favorites()
    {
        return $this->belongsToMany(Shop::class, 'favorites', 'user_id', 'shop_id');
    }


    public function favorite($userId)
    {
        $this->favorites()->attach($userId);
    }

    public function unfavorite($userId)
    {
        $this->favorites()->detach($userId);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if($keyword)
        {
            $query->where('name', 'like', '%'. $keyword . '%');
        }
    }


    public function scopeRoleSearch($query, $role)
    {
        if($role)
        {
            $query->where('role', $role);
        }
    }
}
