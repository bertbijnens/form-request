<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\Extensions;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class ExtensionsTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(Extensions::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['extensions:jpg'], new Extensions('jpg'));
        $this->assertValidationRules(['decimal:jpg,png'], new Extensions('jpg', 'png'));
    }
}
