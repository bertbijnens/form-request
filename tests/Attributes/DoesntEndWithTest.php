<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\DoesntEndWith;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class DoesntEndWithTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(DoesntEndWith::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['doesnt_end_with:a'], new DoesntEndWith('a'));
        $this->assertValidationRules(['doesnt_end_with:a,b'], new DoesntEndWith('a', 'b'));
        $this->assertValidationRules(['doesnt_end_with:a,b,c'], new DoesntEndWith('a', 'b', 'c'));
    }
}
