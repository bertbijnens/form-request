<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\InArray;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class InArrayTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(InArray::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['in_array:another_field'], new InArray('another_field'));
    }
}
