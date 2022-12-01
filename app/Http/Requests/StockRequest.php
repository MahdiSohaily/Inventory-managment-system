<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockRequest extends FormRequest
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
        if ($this->input('id')) {
            return [
                "name" => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:15',
                    Rule::unique('stocks','name')->ignore($this->input('id'))
                ],
                "user_id" => ['bail', 'required', 'numeric', 'exists:users,id',
                    Rule::unique('stocks','user_id')->ignore($this->input('id'))
                ],
                "category_id" => ['bail', 'required', 'numeric', 'exists:categories,id'],
                "description" => ['nullable', 'regex:/^[\pL\s\-]+$/u'],
            ];
        }
        return [
            "name" => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:15', 'unique:stocks,name'],
            "user_id" => ['bail', 'required', 'numeric', 'exists:users,id', 'unique:stocks,user_id'],
            "category_id" => ['bail', 'required', 'numeric', 'exists:categories,id'],
            "description" => ['nullable', 'regex:/^[\pL\s\-]+$/u'],
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
            'exists' => ':attribute انتخاب شده در سیستم موجود نمی باشد',
            'unique' => ':attribute مورد نظر از قبل در سیستم موجود است',
        ];
    }

    public function attributes()
    {
        return [
            /*Custom attribute name for incoming attributes name*/
            'name' => 'نام گدام',
            'user_id' => 'معتمد',
            'category_id' => 'کتگوری',
            'description' => 'توضیحات',
        ];
    }
}
