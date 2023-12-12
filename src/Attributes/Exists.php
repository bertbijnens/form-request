<?php

namespace Anteris\FormRequest\Attributes;

use Attribute;
use Illuminate\Validation\Rules\Exists as BaseExists;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Exists implements Rule
{
    public function __construct(private string $table, private string $column = 'NULL')
    {
        //
    }

    public function getRules(): array
    {
        return [new BaseExists($this->table, $this->column)];
    }
}
