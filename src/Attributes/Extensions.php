<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;
use Illuminate\Validation\Rules\Exists as BaseExists;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Extensions implements Rule
{
    private array $validExtensions;

    public function __construct(string ...$string)
    {
        $this->validExtensions = $string;
    }

    public function getRules(): array
    {
        return ["exclude_without:" . implode(',', $this->validExtensions)];
    }
}
