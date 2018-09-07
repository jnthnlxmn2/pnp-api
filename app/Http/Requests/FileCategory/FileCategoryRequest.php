<?php

namespace App\Http\Requests\FileCategory;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FileCategoryRequest extends FormRequest
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
            'name' => 'required',
            'description' =>'required',
        ];
    }
}
