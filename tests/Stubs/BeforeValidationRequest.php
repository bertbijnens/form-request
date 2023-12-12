<?php

namespace Anteris\Tests\FormRequest\Stubs;

use Anteris\FormRequest\Attributes\Validation;
use Anteris\FormRequest\FormRequestData;

class BeforeValidationRequest extends FormRequestData
{
    #[Validation('required', 'string', 'email', 'lowercase')]
    public string $email;

    protected function beforeValidation(array $properties): array
    {
        $properties['email'] = strtolower($properties['email']);

        return $properties;
    }
}
