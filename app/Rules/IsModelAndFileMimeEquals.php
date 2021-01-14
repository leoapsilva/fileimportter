<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsModelAndFileMimeEquals implements Rule
{

    private $importableModels;
    private $model;
    private $importedMime;
    private $expectedMime;
    private $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($importableModels, $model, $importedMime)
    {
        $this->importableModels = collect($importableModels);
        $this->model = $model;
        $this->importedMime = $importedMime;
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
        $this->expectedMime = $this->importableModels->firstWhere('model', $this->model)['mime'];

        $this->message = "File expected: ". $this->expectedMime . '. Imported: ' . $this->importedMime;

        return str_contains($this->importedMime, $this->expectedMime);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
