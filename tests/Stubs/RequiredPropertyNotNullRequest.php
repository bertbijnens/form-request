<?php

namespace Anteris\Tests\FormRequest\Stubs;

use Anteris\FormRequest\Attributes\Required;
use Anteris\FormRequest\FormRequestData;

class RequiredPropertyNotNullRequest extends FormRequestData
{
    #[Required]
    public string $property;
}
