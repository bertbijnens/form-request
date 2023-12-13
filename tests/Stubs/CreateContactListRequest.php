<?php

namespace Anteris\Tests\FormRequest\Stubs;

use Anteris\FormRequest\Attributes\ArrayOf;
use Anteris\FormRequest\Attributes\Validation;
use Anteris\FormRequest\FormRequestData;

class CreateContactListRequest extends FormRequestData
{
    #[Validation('required', 'string')]
    public string $name;

    #[Validation('sometimes', 'array', 'nullable'), ArrayOf(CreatePersonRequest::class)]
    public ?array $contacts = null;
}
