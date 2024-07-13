<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'shop_name' => 'required|string|max:50',
            // 'select_user' => 'required|exists:users,id',
            // 'area_id' => 'required|in:東京都,大阪府,福岡県',
            // 'genre_id' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
            // 'content' => 'required|string|max:400',
            // 'img_path' => 'required|image|mimes:jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            // 'shop_name.required' => '店舗名は必須です。',
            // 'shop_name.max' => '店舗名は50文字以内で入力してください。',
            // 'select_user.exists' => '指定された店舗代表者ユーザーが存在しません。',
            // 'area_id.in' => '地域は「東京都」「大阪府」「福岡県」のいずれかを選択してください。',
            // 'genre_id.in' => 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを選択してください。',
            // 'content.required' => '内容は必須です。',
            // 'content.max' => '内容は400文字以内で入力してください。',
            // 'img_path.image' => '画像ファイルをアップロードしてください。',
            // 'img_path.mimes' => '画像ファイルの形式はJPEG、PNG、JPG、GIFのいずれかを選択してください。',
            // 'img_path.max' => '画像ファイルのサイズは2MB以内にしてください。',
        ];
    }
}
