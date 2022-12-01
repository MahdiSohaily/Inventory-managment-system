<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodRequest extends FormRequest
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
            'name' => ['bail', ' required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:50'],
            'category_id' => ['bail', 'required', 'numeric', 'min:1', 'exists:categories,id'],
            'unit_id' => ['bail', 'required', 'numeric', 'min:1', 'exists:units,id'],
            'properties' => ['bail', 'required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
            'unique' => 'ایمیل وارده قبلا در سیستم موجود است',
            'numeric' => 'فیلد مورد نظر تنها باید که عدد باشد'
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'نام جنس',
            'category_id'=>'کتگوری',
            'unit_id'=>'واحد',
            'properties'=>'مشخصات جنس',
        ];
    }
}
