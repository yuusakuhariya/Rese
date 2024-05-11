<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    public function scopeKeywordSearch($query, $keyword)
    {
        if(!empty($keyword))
        {
            $query->where('shop_name', 'like', '%'. $keyword. '%');
        }
    }

    public function scopeAreaSearch($query, $area_id)
    {
        if(!empty($area_id))
        {
            $query->where('area_id', $area_id);
        }
    }

        public function scopeGenreSearch($query, $genre_id)
    {
        if (!empty($genre_id))
        {
            $query->where('genre_id', $genre_id);
        }
    }
}
