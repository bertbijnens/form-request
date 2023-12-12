<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\DoesntStartWith;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class DoesntStartWithTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(DoesntStartWith::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['doesnt_start_with:a'], new DoesntStartWith('a'));
        $this->assertValidationRules(['doesnt_start_with:a,b'], new DoesntStartWith('a', 'b'));
        $this->assertValidationRules(['doesnt_start_with:a,b,c'], new DoesntStartWith('a', 'b', 'c'));
    }
}
