<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),  // 関連するユーザーを生成
            'shop_id' => \App\Models\Shop::factory(),  // 関連するショップを生成
            'rating' => $this->faker->numberBetween(1, 5),  // 評価
            'comment' => $this->faker->sentence(),  // コメント
            'img_path' => $this->faker->imageUrl(),  // 画像パス
        ];
    }
}
