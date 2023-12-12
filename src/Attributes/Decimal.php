<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Decimal implements Rule
{
    public function __construct(private int $decimal_places, private ?int $max_decimal_places = null)
    {
        //
    }

    public function getRules(): array
    {
        return ['decimal:' . $this->decimal_places . ($this->max_decimal_places ? ',' . $this->max_decimal_places : '')];
    }
}
