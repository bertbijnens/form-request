<?php

namespace Attributes;

use Anteris\FormRequest\Attributes\Accepted;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class AcceptedTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(Accepted::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['accepted'], new Accepted());
    }
}
