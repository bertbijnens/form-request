<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Prohibits implements Rule
{
    private array $otherFields;

    public function __construct(string ...$otherFields)
    {
        $this->otherFields = $otherFields;
    }

    public function getRules(): array
    {
        return ["prohibits:" . implode(',', $this->otherFields)];
    }
}
