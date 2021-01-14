<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                'first_name' => ['required', 'max:50'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable','string', 'email', 'max:255', 'unique:users'],
                'gender' => ['nullable','string', 'max:25'],
                'ip_address' => ['nullable','ipv4'],
                'company' => ['nullable','string', 'max:50'],
                'city' => ['nullable','string', 'max:50'],
                'title' => ['nullable','string', 'max:50'],
                'website' => ['nullable','active_url', 'max:5000'],
        ];
    }
}
