<?php

namespace Anteris\Tests\FormRequest;

use Anteris\Tests\FormRequest\Stubs\ArrayFormRequest;
use Illuminate\Http\Request;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use PHPUnit\Framework\TestCase;

class ArrayFormTest extends TestCase
{
    public function test_it_can_accept_objects()
    {
        $data = [
            'name' => 'Aidan',
            'list' => [
                'a',
                'b',
                'c'
            ]
        ];

        $objectFormRequest = new ArrayFormRequest(
            $this->createRequest($data),
            $this->createValidationFactory()
        );

        $this->assertSame($data, $objectFormRequest->validated());
        $this->assertSame($data['list'], $objectFormRequest->list);
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
