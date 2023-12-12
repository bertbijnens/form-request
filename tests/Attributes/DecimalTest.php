<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\Decimal;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class DecimalTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(Decimal::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['decimal:2'], new Decimal(2));
        $this->assertValidationRules(['decimal:2,4'], new Decimal(2, 4));
    }
}
