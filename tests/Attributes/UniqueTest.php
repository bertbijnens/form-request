<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\Ulid;
use Anteris\FormRequest\Attributes\Unique;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class UniqueTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(Unique::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['unique:table,column'], new Unique('table', 'column'));
    }
}
