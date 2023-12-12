<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;
use Illuminate\Validation\Rules\NotIn as BaseNotIn;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Missing implements Rule
{
    public function getRules(): array
    {
        return ['missing'];
    }
}
