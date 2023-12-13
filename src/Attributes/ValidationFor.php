<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ValidationFor implements Rule
{
    private array $rules;

    public function __construct(
        private string $target,
        string ...$rules
    ) {
        $this->rules = $rules;
    }

    public function getRules(): array
    {
        return [
            $this->target => $this->rules,
        ];
    }
}
