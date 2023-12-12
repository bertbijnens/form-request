<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\MissingWithAll;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class MissingWithAllTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(MissingWithAll::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['missing_with:foo'], new MissingWithAll('foo'));
        $this->assertValidationRules(['missing_with:foo,bar'], new MissingWithAll('foo', 'bar'));
    }
}
