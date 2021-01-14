<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
                'first_name' => ['required', 'max:50'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'user_id'   => ['required'],
        ];
    }
}
