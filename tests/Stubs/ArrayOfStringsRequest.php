<?php

namespace Anteris\Tests\FormRequest\Stubs;

use Anteris\FormRequest\Attributes\ArrayOf;
use Anteris\FormRequest\Attributes\StartsWith;
use Anteris\FormRequest\Attributes\Validation;
use Anteris\FormRequest\Attributes\ValidationFor;
use Anteris\FormRequest\FormRequestData;

class ArrayOfStringsRequest extends FormRequestData
{
    #[ValidationFor('', 'required', 'string', 'max:1')]
    public array $triggers;
}
