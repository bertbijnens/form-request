<?php

namespace Anteris\FormRequest\Validators;

use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

class FakeValidationFactory extends Factory
{
    /**
     * Validate the given data against the provided rules.
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $attributes
     * @return array
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(array $data, array $rules, array $messages = [], array $attributes = [])
    {
        $this->make($data, $rules, $messages, $attributes);

        return [];
    }


    protected function resolve(array $data, array $rules, array $messages, array $attributes)
    {
        return new FakeValidator($this->translator, $data, $rules, $messages, $attributes);
    }
}
