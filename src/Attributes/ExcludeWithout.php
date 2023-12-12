<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ExcludeWithout implements Rule
{
    public function __construct(private string $another_field)
    {
        //
    }

    public function getRules(): array
    {
        return ["exclude_without:{$this->another_field}"];
    }
}
