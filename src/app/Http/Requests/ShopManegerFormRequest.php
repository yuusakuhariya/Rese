<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopManegerFormRequest extends FormRequest
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
            'shop_name' => 'required',
            'area_name' => 'required',
            'genre_name' => 'required',
            'content' => 'required',
            'img_path' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'shop_name.required' => '店名を記入して下さい',
            'area_name.required' => '地域を記入して下さい',
            'genre_name.required' => 'ジャンルを記入して下さい',
            'content.required' => '詳細を記入して下さい',
            'img_path.required' => '画像を選択して下さい',

        ];
    }
}
