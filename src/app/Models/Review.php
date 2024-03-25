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
    ];

    public function reservation()
    {
        return $this->belongsTo(reservation::class);
    }
}
