<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'name' => 'Required|string',
            'image'=> 'nullable|mimes:jpg,png',
            'category_id' => 'Required|exists:categories,id',
            'description' => 'Required'
        ];
    }

    public function attributes(): array
    {
        return [
          'category_id' => 'category'
        ];
    }

}
