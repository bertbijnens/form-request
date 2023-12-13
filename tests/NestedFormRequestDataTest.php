<?php

namespace Anteris\Tests\FormRequest;

use Anteris\Tests\FormRequest\Stubs\AttributesRequest;
use Anteris\Tests\FormRequest\Stubs\CreateContactListRequest;
use Anteris\Tests\FormRequest\Stubs\CreatePersonRequest;
use Anteris\Tests\FormRequest\Stubs\NullablePropertyRequest;
use Anteris\Tests\FormRequest\Stubs\RequiredPropertyNotNullRequest;
use Illuminate\Http\Request;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class NestedFormRequestDataTest extends TestCase
{
    public function test_it_can_set_properties_when_valid()
    {
        $request = new CreateContactListRequest(
            $this->createRequest([
                'name' => 'emergency contacts',
                'contacts'  => [
                    [
                        'first_name' => 'Larry',
                        'last_name'  => 'Johnson',
                        'email'      => 'larry.johnson@gmail.com'
                    ],
                    [
                        'first_name' => 'Tammy',
                        'last_name'  => 'Johnson',
                        'email'      => 'tammy.johnson@gmail.com',
                    ]
                ]
            ]),
            $this->createValidationFactory()
        );

        $this->assertSame('emergency contacts', $request->name);
        $this->assertSame($request->name, $request->getRequest()->name);
        $this->assertInstanceOf(Request::class, $request->getRequest());
    }

    public function test_it_can_ignore_sometimes()
    {
        $request = new CreateContactListRequest(
            $this->createRequest([
                'name' => 'emergency contacts',
                'contacts' => null
            ]),
            $this->createValidationFactory()
        );

        $this->assertSame('emergency contacts', $request->name);
        $this->assertSame($request->name, $request->getRequest()->name);
        $this->assertInstanceOf(Request::class, $request->getRequest());
    }

    public function test_it_throws_exceptions_when_validation_fails()
    {
        $this->expectException(ValidationException::class);

        new CreateContactListRequest(
            $this->createRequest([
                'name' => 'emergency contacts',
                'contacts'  => [
                    [
                        'first_name' => 'Larry',
                        'last_name'  => 'Johnson',
                        'email'      => null
                    ]
                ]
            ]),
            $this->createValidationFactory()
        );
    }

    public function test_to_array()
    {
        $data = [
            'name' => 'emergency contacts',
            'contacts'  => [
                [
                    'first_name' => 'Larry',
                    'last_name'  => 'Johnson',
                    'email'      => 'larry.johnson@gmail.com'
                ]
            ]
        ];

        $request = new CreateContactListRequest(
            $this->createRequest($data),
            $this->createValidationFactory()
        );

        $this->assertSame(
            $data,
            $request->toArray()
        );
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
