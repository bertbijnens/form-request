<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MaxDigits implements Rule
{
    public function __construct(private int $value)
    {
        //
    }

    public function getRules(): array
    {
        return ['max_digits:' . $this->value];
    }
}
