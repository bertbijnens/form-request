<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\MissingIf;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class MissingIfTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(MissingIf::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['missing_if:another_field,value1'], new MissingIf('another_field', 'value1'));
        $this->assertValidationRules(['missing_if:another_field,value1,value2'], new MissingIf('another_field', 'value1', 'value2'));
    }
}
