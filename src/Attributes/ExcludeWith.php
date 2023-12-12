<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ExcludeWith implements Rule
{
    public function __construct(private string $another_field)
    {
        //
    }

    public function getRules(): array
    {
        return ["exclude_with:{$this->another_field}"];
    }
}
