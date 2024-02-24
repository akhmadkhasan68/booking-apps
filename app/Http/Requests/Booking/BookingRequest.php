<?php

namespace App\Http\Requests\Booking;

use App\Enums\DivisionTypeEnum;
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
                'nullable',
                'numeric',
                Rule::exists('divisions', 'id'),
            ],
            'participant_type' => [
                'required',
                Rule::in([
                    DivisionTypeEnum::INTERNAL,
                    DivisionTypeEnum::EXTERNAL,
                    DivisionTypeEnum::GABUNGAN,
                ]),
            ],
            'room_id' => [
                'required',
                'numeric',
                Rule::exists('rooms', 'id'),
            ],
            'nip' => 'required',
            'phone' => 'required',
            'start_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . date(DATE_ATOM),
            'end_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . $this->start_date,
            'participant_internal' => 'required|numeric',
            'participant_external' => 'required|numeric',
            'description' => 'required',
            'attachment' => 'required|file|mimes:jpg,png,jpeg,pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
        ];
    }
}
