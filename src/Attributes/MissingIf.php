<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;
use Illuminate\Validation\Rules\NotIn as BaseNotIn;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MissingIf implements Rule
{
    public function __construct(private int $another_field, private $value)
    {
        //
    }
    public function getRules(): array
    {
        return ['missing_if:' . $this->another_field . ',' . $this->value];
    }
}
