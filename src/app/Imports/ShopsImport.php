<?php

namespace App\Imports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Area;
use App\Models\Genre;
use Maatwebsite\Excel\Concerns\WithValidation;

class ShopsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function model(array $row)
    {

        $area = Area::where('area_name', $row['area_name'])->first();
        $genre = Genre::where('genre_name', $row['genre_name'])->first();

        return new Shop([
            'shop_name' => $row['shop_name'],
            'user_id' => $this->userId,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $row['content'],
            'img_path' => $row['img_path'],
        ]);
    }

    public function rules(): array
    {
        return [
            'shop_name' => 'required|string|max:50',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'shop_name.required' => '店舗名は必須です。',
        ];
    }
}
