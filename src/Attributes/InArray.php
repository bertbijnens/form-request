<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class InArray implements Rule
{
    public function __construct(private string $another_field)
    {
        //
    }

    public function getRules(): array
    {
        return ["in_array:{$this->another_field}"];
    }
}
