<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class SearchAvailableRequest extends FormRequest
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
            'start_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . date(DATE_ATOM),
            'end_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . $this->start_date
        ];
    }
}
