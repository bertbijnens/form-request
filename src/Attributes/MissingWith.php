<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;
use Illuminate\Validation\Rules\NotIn as BaseNotIn;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MissingWith implements Rule
{
    private array $otherFields;

    public function __construct(string ...$otherFields)
    {
        $this->otherFields = $otherFields;
    }

    public function getRules(): array
    {
        return ['missing_with:' . implode(',', $this->otherFields)];
    }
}
