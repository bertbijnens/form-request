<?php

namespace Anteris\Tests\FormRequest\Attributes;

use Anteris\FormRequest\Attributes\HexColor;
use Anteris\Tests\FormRequest\Support\TestsValidationAttributes;
use PHPUnit\Framework\TestCase;

class HexColorTest extends TestCase
{
    use TestsValidationAttributes;

    public function test_it_is_a_validation_attribute()
    {
        $this->assertValidationAttribute(HexColor::class);
    }

    public function test_it_returns_correct_rules()
    {
        $this->assertValidationRules(['hex_color'], new HexColor());
    }
}
