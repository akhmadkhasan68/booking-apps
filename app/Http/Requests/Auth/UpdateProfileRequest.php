<?php

namespace App\Http\Requests\Auth;

use App\Constants\GenderConstant;
use App\Models\Division;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'phone' => [
                'required',
                Rule::unique('users')->ignore($this->user()->id, 'id')
            ],
            'division_id' => [
                'required',
                Rule::in(Division::get()->pluck('id'))
            ],
            'gender' => [
                'required',
                Rule::in([GenderConstant::FEMALE, GenderConstant::MALE])
            ],
            'address' => 'required',
            'nip' => [
                'required',
                Rule::unique('members')->ignore($this->user()->member->id, 'id')
            ]
        ];
    }
}
