<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DoesntStartWith implements Rule
{
    private array $invalidStartingStrings;

    public function __construct(string ...$string)
    {
        $this->invalidStartingStrings = $string;
    }

    public function getRules(): array
    {
        return ["doesnt_start_with:" . implode(',', $this->invalidStartingStrings)];
    }
}
