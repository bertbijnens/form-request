<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ValidateArray implements Rule
{
    private array $rules;

    public function __construct(
        string ...$rules
    ) {
        $this->rules = $rules;
    }

    public function getRules(): array
    {
        return [
            '' => $this->rules,
        ];
    }
}
