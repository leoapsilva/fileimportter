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
    public function __construct($importableModels, $importedModel, $importedMime)
    {
        $this->importableModels = $importableModels;
        $this->importedModel = $importedModel;
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
        $this->expectedMime = collect($this->importableModels)->firstWhere('model', '=', $this->importedModel)['mime'];

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
