<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Unique implements Rule
{
    public function __construct(private string $table, private string $column)
    {
        //
    }

    public function getRules(): array
    {
        return ['unique:' . $this->table . ',' . $this->column];
    }
}
