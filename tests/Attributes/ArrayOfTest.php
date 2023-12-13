<?php

namespace Attributes;

use Anteris\FormRequest\Attributes\ArrayOf;
use Anteris\Tests\FormRequest\Stubs\CreatePersonRequest;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class ArrayOfTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(ArrayOf::class);
    }

    public function test_it_returns_correct_rules()
    {
        $validateFor = new ArrayOf(CreatePersonRequest::class);

        $this->assertValidationRules([
            'first_name' => [
                'required', 'string'
            ],
            'last_name' => [
                'required', 'string'
            ],
            'email' => [
                'required', 'string', 'email',
            ],
        ], $validateFor);
    }
}
