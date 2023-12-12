<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\DeclinedIf;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class DeclinedIfTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(DeclinedIf::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['declined_if:field,value1'], new DeclinedIf('field', 'value1'));
        $this->assertValidationRules(['declined_if:field,value1,value2'], new DeclinedIf('field', 'value1', 'value2'));
    }
}
