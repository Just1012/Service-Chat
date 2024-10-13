<?php

namespace App\Http\Requests;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'           => 'nullable|exists:sliders,id',
            'type'         => 'required|numeric|between:0,3',
            'type_category'=> 'nullable|required_if:type,1|max:255|string',
            'type_services'=> 'nullable|required_if:type,2|max:255|string',
            'type_text'    => 'nullable|required_if:type,3|max:255|string',
            'image'        => 'image|mimes:jpeg,png,jpg|max:6502|required_if:id,null',
        ];
    }

    public function messages()
    {
        return [
            'type.required'          => 'حقل النوع مطلوب.',
            'type.numeric'           => 'حقل النوع يجب أن يكون قيمة رقمية.',
            'type.between'           => 'حقل النوع يجب أن يكون بين :min و :max.',
            'type_category.required_if' => 'حقل :attribute مطلوب عند اختيار نوع العنصر.',
            'type_category.max'      => 'حقل :attribute يجب ألا يتجاوز :max حرفًا.',
            'type_category.string'   => 'حقل :attribute يجب أن يكون نصًا.',
            'type_services.required_if' => 'حقل :attribute مطلوب عند اختيار نوع العنصر.',
            'type_services.max'      => 'حقل :attribute يجب ألا يتجاوز :max حرفًا.',
            'type_services.string'   => 'حقل :attribute يجب أن يكون نصًا.',
            'type_text.required_if' => 'حقل :attribute مطلوب عند اختيار نوع العنصر.',
            'type_text.max'         => 'حقل :attribute يجب ألا يتجاوز :max حرفًا.',
            'type_text.string'      => 'حقل :attribute يجب أن يكون نصًا.',
            // Add more messages as needed for other fields

            'image.required_if'     => 'حقل الصورة مطلوب إذا كانت هذه عملية إنشاء جديدة.',
            'image.image'           => 'يجب أن يكون الملف عبارة عن صورة.',
            'image.mimes'           => 'يجب أن يكون الملف من نوع: jpeg، png، jpg.',
            'image.max'             => 'يجب أن يكون حجم الصورة أقل من :max كيلوبايت.',
            // Add more messages as needed for image validation

            'id.exists'             => 'العنصر المحدد غير موجود.',
        ];

    }
    protected function failedValidation(Validator $validator)
    {
        $errorMessages = $validator->errors()->all();

        // Display each error message with Toastr
        foreach ($errorMessages as $errorMessage) {
            toastr()->error($errorMessage,'Error');
        }

        parent::failedValidation($validator);
    }
}
