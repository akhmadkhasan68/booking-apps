<?php

namespace App\Http\Requests\Auth;

use App\Constants\GenderConstant;
use App\Models\Division;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|unique:users',
            'division_id' => [
                'required',
                Rule::in(Division::get()->pluck('id'))
            ],
            'gender' => [
                'required',
                Rule::in([GenderConstant::FEMALE, GenderConstant::MALE])
            ],
            'address' => 'required',
            'nip' => 'required|unique:members'
        ];
    }
}
