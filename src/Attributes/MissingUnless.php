<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;
use Illuminate\Validation\Rules\NotIn as BaseNotIn;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MissingUnless implements Rule
{
    public function __construct(private int $another_field, private $value)
    {
        //
    }
    public function getRules(): array
    {
        return ['missing_unless:' . $this->another_field . ',' . $this->value];
    }
}
