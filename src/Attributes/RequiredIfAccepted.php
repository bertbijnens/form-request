<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class RequiredIfAccepted implements Rule
{
    private array $otherFields;

    public function __construct(string ...$otherFields)
    {
        $this->otherFields = $otherFields;
    }

    public function getRules(): array
    {
        return [
            "required_if_accepted:" . implode(',', $this->otherFields),
        ];
    }
}
