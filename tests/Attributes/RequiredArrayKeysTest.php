<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\RequiredArrayKeys;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class RequiredArrayKeysTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(RequiredArrayKeys::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['required_array_keys:foo'], new RequiredArrayKeys('foo'));
        $this->assertValidationRules(['required_array_keys:foo,bar'], new RequiredArrayKeys('foo', 'bar'));
    }
}
