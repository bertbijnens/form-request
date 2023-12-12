<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Declined implements Rule
{
    public function __construct()
    {
        //
    }

    public function getRules(): array
    {
        return ['declined'];
    }
}
