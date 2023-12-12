<?php

namespace Anteris\Tests\FormRequest\Stubs;

use Anteris\FormRequest\Attributes\Validation;
use Anteris\FormRequest\FormRequestData;

class AfterValidationRequest extends FormRequestData
{
    #[Validation('required', 'string', 'email')]
    public string $email;

    protected function afterValidation()
    {
        $this->email = strtolower('email');
    }
}
