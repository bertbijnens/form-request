<?php

namespace Anteris\Tests\FormRequest\Stubs;

use Anteris\FormRequest\Attributes\Email;
use Anteris\FormRequest\Attributes\Required;
use Anteris\FormRequest\Attributes\Same;
use Anteris\FormRequest\Attributes\StartsWith;
use Anteris\FormRequest\Attributes\ValidateArray;
use Anteris\FormRequest\Attributes\ValidationFor;
use Anteris\FormRequest\FormRequestData;

class ArrayFormRequest extends FormRequestData
{
    public string $name;

    #[ValidateArray('string')]
    public array $list;
}
