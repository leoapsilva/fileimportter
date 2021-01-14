<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Already authorized by middleware on route.
        // No policy or gate defined for this resource thus returns true.
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
            'country' => ['nullable', 'string', 'max:5'],
            'area' => ['nullable', 'string', 'max:5'],
            'number' => ['required','string', 'max:20'],
            'person_id' => ['required'],
        ];
    }
}
