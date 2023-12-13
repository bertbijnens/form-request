<?php

namespace Attributes;

use Anteris\FormRequest\Attributes\ValidateArray;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class ValidateArrayTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(ValidateArray::class);
    }

    public function test_it_returns_correct_rules()
    {
        $validateArray = new ValidateArray('required', 'string');

        $this->assertValidationRules([
            '' => [
                'required', 'string'
            ]
        ], $validateArray);
    }
}
