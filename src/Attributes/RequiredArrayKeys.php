<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class RequiredArrayKeys implements Rule
{
    private array $array_keys;

    public function __construct(string ...$array_keys)
    {
        $this->array_keys = $array_keys;
    }

    public function getRules(): array
    {
        return [
            'required_array_keys:' . implode(',', $this->array_keys),
        ];
    }
}
