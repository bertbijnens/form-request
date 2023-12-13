<?php

namespace Attributes;

use Anteris\FormRequest\Attributes\ArrayOf;
use Anteris\FormRequest\Attributes\ValidationFor;
use Anteris\Tests\FormRequest\Stubs\CreatePersonRequest;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class ValidationForTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(ValidationFor::class);
    }

    public function test_it_returns_correct_rules()
    {
        $validateFor = new ValidationFor('name', 'required', 'string');

        $this->assertValidationRules([
            'name' => [
                'required', 'string'
            ]
        ], $validateFor);

        $validateFor = new ValidationFor('name', 'required', 'integer');

        $this->assertValidationRules([
            'name' => [
                'required', 'integer'
            ]
        ], $validateFor);
    }
}
