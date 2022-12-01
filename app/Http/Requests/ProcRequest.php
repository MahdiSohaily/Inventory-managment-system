<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcRequest extends FormRequest
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
            'type' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u'],
            'start' => ['bail', 'required', 'date'],
            'end' => ['bail', 'required', 'date', 'after:start'],
        ];
    }

    public function messages()
    {
        return [
            /*Custom Validation Messages for Above Validation Rules*/
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'date' => 'مقدار وارد شده یک فارمت تاریخ معتبر نمی باشد',
            'after' => 'تاریخ پایان باید بعد از تاریخ شروع باشد',
        ];
    }

    public function attributes()
    {
        return [
            /*Custom attribute name for incoming attributes name*/
            'type' => 'نوعیت هیئت',
            'start' => 'تاریخ شروع',
            'end' => 'تاریخ پایان',
        ];
    }
}
