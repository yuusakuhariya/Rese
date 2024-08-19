<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_name' => $this->faker->company,
            'user_id' => \App\Models\User::factory(),
            'area_id' => \App\Models\Area::factory(),
            'genre_id' => \App\Models\Genre::factory(),
            'content' => $this->faker->text,
            'img_path' => $this->faker->imageUrl,
        ];
    }
}
