<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\ExcludeWithout;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class ExcludeWithoutTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(ExcludeWithout::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(
            ['exclude_without:another_field'],
            new ExcludeWithout('another_field')
        );
    }
}
