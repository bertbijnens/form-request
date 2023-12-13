<?php

namespace Anteris\FormRequest\Validators;

use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

class FakeValidator extends Validator
{
    public function validate()
    {
        //throw_if($this->fails(), $this->exception, $this);

        return $this->validated();
    }
}
