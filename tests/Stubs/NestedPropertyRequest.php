<?php

namespace Anteris\Tests\FormRequest\Stubs;

use Anteris\FormRequest\Attributes\ArrayOf;
use Anteris\FormRequest\Attributes\Validation;
use Anteris\FormRequest\FormRequestData;

class NestedPropertyRequest extends FormRequestData
{
    public CreatePersonRequest $favorite;
}
