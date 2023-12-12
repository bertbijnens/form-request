<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class HexColor implements Rule
{
    public function getRules(): array
    {
        return ['hex_color'];
    }
}
