<?php

namespace App\Http\Requests;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|exists:categories,id',
            'name_ar' => 'required|max:255|string',
            'name_en' => 'required|max:255|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'status' => 'nullable|boolean',
            'image' => 'image|mimes:jpeg,png,jpg|max:6502|required_if:id,null',
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required'          => 'الاسم بالعربية مطلوب',
            'name_ar.max'               => 'الاسم بالعربية يجب أن يحتوي على أقل من 255 حرف',
            'name_ar.string'            => 'الاسم بالعربية يجب أن يكون نص',

            'name_en.required'          => 'الاسم بالإنجليزية مطلوب',
            'name_en.max'               => 'الاسم بالإنجليزية يجب أن يحتوي على أقل من 255 حرف',
            'name_en.string'            => 'الاسم بالإنجليزية يجب أن يكون نص',

            'description_ar.required'   => 'الوصف بالعربية مطلوب',
            'description_ar.string'     => 'الوصف بالعربية يجب أن يكون نص',

            'description_en.required'   => 'الوصف بالإنجليزية مطلوب',
            'description_en.string'     => 'الوصف بالإنجليزية يجب أن يكون نص',

            'image.image'               => 'الملف يجب أن يكون صورة',
            'image.mimes'               => 'نوع الصورة يجب أن يكون: jpeg، png، jpj',
            'image.max'                 => 'حجم الصورة يجب أن لا يتجاوز 5 ميغابايت',
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
