<?php

namespace App\Imports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Area;
use App\Models\Genre;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Contracts\Validation\Rule;

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
            'area_name' => 'required|in:東京都,大阪府,福岡県',
            'genre_name' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
            'content' => 'required|string|max:400',
            'img_path' => [
                'required',
                'url',
                new AllowedImageFormat,
                'max:2048',
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'shop_name.required' => '店舗名は必ず記入してください。',
            'shop_name.max' => '店舗名は50字以内で記入してください。',
            'area_name.required' => '地域名は必ず記入してください。',
            'area_name.in' => '地域は「東京都」「大阪府」「福岡県」のいずれかを選択してください。',
            'genre_name.required' => 'ジャンル名は必ず記入してください。',
            'genre_name.in' => 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを選択してください。',
            'content.required' => '店舗概要は必ず記入してください。',
            'content.max' => '店舗概要は400字以内で記入してください。',
            'img_path.required' => '画像URLは必ず記入してください。',
            'img_path.url' => '画像はURLで指定してください。',
            'img_path.max' => '画像ファイルのサイズは2MB以内にしてください。',
        ];
    }
}

class AllowedImageFormat implements Rule
{
    public function passes($attribute, $value)
    {
        // 画像の拡張子を取得する
        $extension = strtolower(pathinfo($value, PATHINFO_EXTENSION));

        // 許可する画像形式
        $allowedFormats = ['jpg', 'png'];

        // 拡張子が許可する形式に含まれているかチェックする
        return in_array($extension, $allowedFormats);
    }

    public function message()
    {
        return '画像ファイルの形式はPNG、JPGのいずれかを選択してください。';
    }
}