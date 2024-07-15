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

        $area = Area::where('area_name', $row['地域名'])->first();
        $genre = Genre::where('genre_name', $row['ジャンル名'])->first();

        return new Shop([
            'shop_name' => $row['店舗名'],
            'user_id' => $this->userId,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $row['店舗概要'],
            'img_path' => $row['画像URL'],
        ]);
    }

    public function rules(): array
    {
        return [
            '店舗名' => 'required|string|max:50',
            '地域名' => 'required|in:東京都,大阪府,福岡県',
            'ジャンル名' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
            '店舗概要' => 'required|string|max:400',
            '画像URL' => [
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
            '店舗名.required' => '店舗名は必ず記入してください。',
            '店舗名.max' => '店舗名は50字以内で記入してください。',
            '地域名.required' => '地域名は必ず記入してください。',
            '地域名.in' => '地域は「東京都」「大阪府」「福岡県」のいずれかを選択してください。',
            'ジャンル名.required' => 'ジャンル名は必ず記入してください。',
            'ジャンル名.in' => 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを選択してください。',
            '店舗概要.required' => '店舗概要は必ず記入してください。',
            '店舗概要.max' => '店舗概要は400字以内で記入してください。',
            '画像URL.required' => '画像URLは必ず記入してください。',
            '画像URL.url' => '画像はURLで指定してください。',
            '画像URL.max' => '画像ファイルのサイズは2MB以内にしてください。',
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