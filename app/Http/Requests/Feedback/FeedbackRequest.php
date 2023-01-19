<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeedbackRequest extends FormRequest
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
            'room_id' => [
                'required',
                'numeric',
                Rule::exists('rooms', 'id')
            ],
            'description' => 'required',
            'medias' => 'required',
            'medias.*' => 'required|mimes:jpg,png,jpeg|max:2048'
        ];
    }
}
