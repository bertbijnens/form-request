<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\MissingUnless;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class MissingUnlessTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(MissingUnless::class);
    }

    public function test_it_returns_correct_rules()
    {
        //TODO docs seem incorrect: https://laravel.com/docs/10.x/validation#rule-missing-unless
        $this->assertValidationRules(['missing_unless:another_field,value1'], new MissingUnless('another_field', 'value1'));
        $this->assertValidationRules(['missing_unless:another_field,value1,value2'], new MissingUnless('another_field', 'value1', 'value2'));
    }
}
