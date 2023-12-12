<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\MissingWith;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class MissingWithTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(MissingWith::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['missing_with:foo'], new MissingWith('foo'));
        $this->assertValidationRules(['missing_with:foo,bar'], new MissingWith('foo', 'bar'));
    }
}
