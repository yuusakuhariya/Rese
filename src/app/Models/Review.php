<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'rating',
        'comment',
        'img_path',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeReviewSearch($query, $shop_id)
    {
        if ($shop_id) {
            $query->where('shop_id', $shop_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if ($keyword) {
            $query->whereHas('shop', function ($query) use ($keyword) {
                $query->where('shop_name', 'like', '%' . $keyword . '%');
            });
        }
    }
}
