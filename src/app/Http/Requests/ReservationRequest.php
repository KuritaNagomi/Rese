<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required',
            'date' => 'required',
            'time' => 'required',
            'num_of_users' => 'required'
        ];
    }

    public function messages()
    {
        return [
        'date.required' => '日付を選択してください',
        'time.required' => '予約時間を選択してください',
        'num_of_users.required' => '人数を選択してください',
        ];
    }
}
