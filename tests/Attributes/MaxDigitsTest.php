<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\MaxDigits;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class MaxDigitsTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(MaxDigits::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['max:2'], new MaxDigits(2));
    }
}
