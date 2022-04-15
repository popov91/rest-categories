<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'         => 'required|string|unique:App\Models\Product,name',
            'price'        => 'required|numeric',
            'is_published' => 'required|boolean',
            'categories'   => 'array|required|min:2|max:20',
            'categories.*' => 'string|exists:categories,name'
        ];
    }
}
