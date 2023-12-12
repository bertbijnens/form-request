<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\Json;
use Anteris\FormRequest\Attributes\Lowercase;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class LowercaseTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(Lowercase::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['lowercase'], new Lowercase());
    }
}
