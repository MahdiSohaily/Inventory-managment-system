<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandRequest extends FormRequest
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
            'section' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:50'],
            'name' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:50'],
            'date' => ['bail', 'required', 'date'],
            'good_id' => ['bail','required','exists:goods,id','min:1'],
            'quantity' => ['bail','required','min:1'],
            'description' => ['nullable','string'],
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
        ];
    }

    public function attributes()
    {
        return [
            'section' => 'شعبه درخواست کننده',
            'name' => 'اسم درخواست کننده',
            'date' => 'تاریخ درخواست',
            'good_id' => 'جنس مورد نظر',
            'quantity' => 'مقدار مورد نظر',
            'description' => 'توضیحات درخواست',
        ];
    }
}
