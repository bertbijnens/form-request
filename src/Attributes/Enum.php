<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Enum implements Rule
{
    public function __construct(private string $enum)
    {
        //
    }

    public function getRules(): array
    {
        return [\Illuminate\Validation\Rule::enum($this->enum)];
    }
}
