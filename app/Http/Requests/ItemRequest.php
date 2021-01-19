<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => ['required', 'string', 'max:255'],
            'note'          => ['required', 'string', 'max:512'],
            'quantity'      => ['required', 'integer'],
            'price'         => ['required', 'float'],
            'ship_order_id' => ['required'],
            ];
    }
}
