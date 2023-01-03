<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginateRequest extends FormRequest
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
            'order_by' => 'nullable|string',
            'sort_by' => 'nullable|string',
            'per_page' => 'nullable|numeric',
            'page' => 'nullable|numeric',
            'search' => 'nullable|string'
        ];
    }
}
