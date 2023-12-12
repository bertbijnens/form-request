<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DeclinedIf implements Rule
{
    private array $values;

    public function __construct(private string $anotherField, string ...$values)
    {
        $this->values = $values;
    }

    public function getRules(): array
    {
        return ['declined_if:' . $this->anotherField . ',' . implode(',', $this->values)];
    }
}
