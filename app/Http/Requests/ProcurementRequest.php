<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcurementRequest extends FormRequest
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
            "name" => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:15'],
            "last_name" => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:15'],
            "position" => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:30'],
            'type' => ['bail', 'required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            /*Custom Validation Messages for Above Validation Rules*/
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
            'unique' => 'ایمیل وارده قبلا در سیستم موجود است',
            'after' => 'تاریخ ختم باید بعد از تاریخ شروع باشد',
            'date' => 'مقذار وارد شده یک تاریخ معتبر نمی باشد',
            'numeric' => 'مقدار وارد شده درست نمی باشد'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'نام',
            'last_name' => 'فامیلی',
            'type' => 'نوعیت هیئت',
            'position' => 'وظیفه',
            'start' => 'تاریخ شروع',
            'end' => 'تاریخ ختم',
        ];
    }
}
