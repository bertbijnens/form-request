<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DoesntEndWith implements Rule
{
    private array $invalidEndingStrings;

    public function __construct(string ...$string)
    {
        $this->invalidEndingStrings = $string;
    }

    public function getRules(): array
    {
        return ["doesnt_end_with:" . implode(',', $this->invalidEndingStrings)];
    }
}
