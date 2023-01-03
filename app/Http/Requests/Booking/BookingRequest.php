<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
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
            'division_id' => [
                'required',
                'numeric',
                Rule::exists('divisions', 'id')
            ],
            'room_id' => [
                'required',
                'numeric',
                Rule::exists('rooms', 'id')
            ],
            'nip' => 'required',
            'phone' => 'required',
            'start_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . date(DATE_ATOM),
            'end_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . $this->start_date,
            'participant' => 'required|numeric',
            'description' => 'required'
        ];
    }
}
