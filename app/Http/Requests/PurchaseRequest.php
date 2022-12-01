<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'seller_one' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:100'],
            'seller_two' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:100'],
            'seller_three' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:100'],
            'price_one' => ['bail', 'required', 'numeric', 'min:1'],
            'price_two' => ['bail', 'required', 'numeric', 'min:1'],
            'price_three' => ['bail', 'required', 'numeric', 'min:1'],
            'good_id' => ['bail', 'required', 'numeric', 'exists:goods,id'],
            'quantity' => ['bail', 'required', 'numeric', 'min:1'],
            'date' => ['bail', 'required', 'date'],
            'proc_id' => ['bail', 'required', 'numeric', 'exists:procurements,id'],
            'status' => ['bail', 'required', 'numeric'],
            'description' => ['bail','nullable', 'regex:/^[\pL\s\-]+$/u'],
            'sokok' => ['bail', 'required', 'numeric', 'min:0'],
            'tax' => ['bail', 'required', 'numeric', 'min:0'],
            'taminat' => ['bail', 'required', 'numeric', 'min:0'],
            'kasrat' => ['bail', 'required', 'numeric', 'min:0'],
            'payment' => ['bail', 'required', 'numeric', 'min:0'],
            'prepared' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u'],
            'manzori' => ['bail', 'required', 'date'],
            'amer' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u'],
            'boss' => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u'],
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
            'exists' => 'مقدار وارد شده در سیستم موجود نیست'
        ];
    }

    public function attributes()
    {
        return [
            'seller_one' => 'فروشنده',
            'seller_two' => 'فروشنده',
            'seller_three' => 'فروشنده',
            'price_one' => 'قیمت جنس',
            'price_two' => 'قیمت جنس',
            'price_three' => 'قیمت جنس',
            'good_id' => ' جنس',
            'quantity' => 'تعداد جنس',
            'date' => 'تاریخ',
            'proc_id' => 'هیئت خریداری',
            'status' => 'حالت خریداری',
            'description' => 'توضیحات',
            'sokok' => 'صکوک',
            'tax' => 'مالیه',
            'taminat' => 'تأمینات',
            'kasrat' => 'کسرات',
            'payment' => 'مقدار قابل تادیه',
            'prepared' => 'تهیه کننده',
            'manzori' => 'تاریخ منظوری',
            'amer' => 'آمر خریداری',
            'boss' => 'رئيس اعطا',
        ];
    }
}
