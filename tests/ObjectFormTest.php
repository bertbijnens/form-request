<?php

namespace Anteris\Tests\FormRequest;

use Anteris\Tests\FormRequest\Stubs\ObjectFormRequest;
use Illuminate\Http\Request;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use PHPUnit\Framework\TestCase;

class ObjectFormTest extends TestCase
{
    public function test_it_can_accept_objects()
    {
        $data = [
            'name' => 'Aidan',
            'address' => [
                'street' => 'streetname'
            ]
        ];

        $objectFormRequest = new ObjectFormRequest(
            $this->createRequest($data),
            $this->createValidationFactory()
        );

        $this->assertSame($data, $objectFormRequest->validated());
        $this->assertSame($data['address']['street'], $objectFormRequest->address->street);
    }

    private function createRequest(array $data = []): Request
    {
        return Request::create('/', 'GET', $data);
    }

    private function createValidationFactory(): Factory
    {
        return new Factory(
            new Translator(
                new ArrayLoader(),
                'en'
            )
        );
    }
}
