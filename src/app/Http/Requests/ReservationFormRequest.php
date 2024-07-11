<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationFormRequest extends FormRequest
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
            'date' => 'required',
            'time' => 'required',
            'number_of_person' => 'required',
            'price' => 'numeric',
        ];
    }
    public function messages()
    {
        return [
            'date.required' => '日付を選択して下さい',
            'time.required' => '時間を選択して下さい',
            'number_of_person.required' => '人数を選択して下さい',
            'price.numeric' => '数字を入れて下さい',
        ];
    }
}
