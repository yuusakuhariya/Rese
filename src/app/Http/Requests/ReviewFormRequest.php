<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewFormRequest extends FormRequest
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
            'rating' => 'required',
            'comment' => 'required|string|max:400',
            'img_path' => 'required|file|image|mimes:jpeg,png|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'rating.required' => '星を指定してください！',
            'comment.max' => 'コメントは400文字以内で入力してください！',
            'comment.required' => 'コメントを入力してください！',
            'img_path.required' => '画像ファイルをアップロードしてください！',
            'img_path.image' => '画像ファイルはjpegまたはpng形式のみアップロード可能です。',
            'img_path.mimes' => '画像ファイルはjpegまたはpng形式のみアップロード可能です。',
            'img_path.max' => '画像ファイルは最大2MBまでアップロード可能です。',

        ];
    }
}
