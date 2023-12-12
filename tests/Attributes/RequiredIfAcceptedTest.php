<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\RequiredIfAccepted;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class RequiredIfAcceptedTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(RequiredIfAccepted::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['required_if_accepted:foo'], new RequiredIfAccepted('foo'));
        $this->assertValidationRules(['required_if_accepted:foo,bar'], new RequiredIfAccepted('foo', 'bar'));
    }
}
