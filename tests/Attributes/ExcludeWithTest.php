<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\ExcludeWith;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class ExcludeWithTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(ExcludeWith::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(
            ['exclude_with:another_field'],
            new ExcludeWith('another_field')
        );
    }
}
