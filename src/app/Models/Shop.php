<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'area_id',
        'genre_id',
        'content',
        'img_path',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // キーワード（店の名前）検索機能
    public function scopeKeywordSearch($query, $keyword)
    {
        if(!empty($keyword))
        {
            $query->where('shop_name', 'like', '%'. $keyword. '%');
        }
    }

    // 地域選択機能
        public function scopeAreaSearch($query, $area_id)
        {
            if(!empty($area_id))
            {
                $query->where('area_id', $area_id);
            }
        }

    // ジャンル選択機能
        public function scopeGenreSearch($query, $genre_id)
        {
            if (!empty($genre_id))
            {
                $query->where('genre_id', $genre_id);
            }
        }

}
