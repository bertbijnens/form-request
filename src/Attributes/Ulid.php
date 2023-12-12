<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Ulid implements Rule
{
    public function getRules(): array
    {
        return ['ulid'];
    }
}
