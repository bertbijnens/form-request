<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Lowercase implements Rule
{
    public function getRules(): array
    {
        return ['lowercase'];
    }
}
