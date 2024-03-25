<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名前を入力して下さい',
            'name.strings' => '名前を文字で入力して下さい',
            'name.max:255' => '255文字以下で入力して下さい',
            'email.required' => 'メールアドレスを入力して下さい',
            'email.strings' => 'メールアドレスを文字で入力して下さい',
            'email.email' => 'メールアドレスを入力して下さい',
            'email.max:255' => '255文字以下で入力して下さい',
            'password.required' => 'パスワードを入力して下さい',
            'password.strings' => 'パスワードを文字で入力して下さい',
            'password.min:8' => 'パスワードを８文字以上で入力して下さい',
        ];
    }
}
