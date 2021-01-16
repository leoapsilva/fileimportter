<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsParsedFileImported implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //dd(request()->file('csv_file'));
        $this->store = request()->file('csv_file')->store('csv');
        $this->path = storage_path('app/public') . '/' . $this->store;

        libxml_use_internal_errors(true);
        $this->sxe = \simplexml_load_file($this->path);
        if (!$this->sxe){
            foreach (libxml_get_errors() as $error) {
                $this->messages[] = $error->message;
            }
        }
        return $this->sxe;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->messages;
    }
}
