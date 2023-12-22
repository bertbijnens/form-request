<?php

namespace Anteris\Tests\FormRequest;

use Anteris\Tests\FormRequest\Stubs\AttributesRequest;
use Anteris\Tests\FormRequest\Stubs\CreateContactListRequest;
use Anteris\Tests\FormRequest\Stubs\CreatePersonRequest;
use Anteris\Tests\FormRequest\Stubs\NestedPropertyRequest;
use Anteris\Tests\FormRequest\Stubs\NullablePropertyRequest;
use Anteris\Tests\FormRequest\Stubs\OptionalNestedPropertyRequest;
use Anteris\Tests\FormRequest\Stubs\RequiredPropertyNotNullRequest;
use Illuminate\Http\Request;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class NestedObjectDataTest extends TestCase
{
    public function test_it_can_set_properties_when_valid()
    {
        $request = new NestedPropertyRequest(
            $this->createRequest([
                'favorite' => [
                    'first_name' => 'Larry',
                    'last_name'  => 'Johnson',
                    'email'      => 'larry.johnson@gmail.com'
                ],
            ]),
            $this->createValidationFactory()
        );

        $this->assertSame('Larry', $request->favorite->first_name);
        $this->assertSame('Johnson', $request->favorite->last_name);
        $this->assertSame('larry.johnson@gmail.com', $request->favorite->email);

        $this->assertSame($request->favorite->first_name, $request->getRequest()->favorite['first_name']);
        $this->assertSame($request->favorite->last_name, $request->getRequest()->favorite['last_name']);
        $this->assertSame($request->favorite->email, $request->getRequest()->favorite['email']);

        $this->assertInstanceOf(Request::class, $request->getRequest());
    }

    /*
    public function test_it_throws()
    {
        $this->expectException(ValidationException::class);

        new NestedPropertyRequest(
            $this->createRequest([]),
            $this->createValidationFactory()
        );
    }

    public function test_it_throws_when_partial()
    {
        $this->expectException(ValidationException::class);

        new NestedPropertyRequest(
            $this->createRequest([
                'favorite' => []
            ]),
            $this->createValidationFactory()
        );
    }

    public function test_it_throws_when_null()
    {
        $this->expectException(ValidationException::class);

        new NestedPropertyRequest(
            $this->createRequest([
                'favorite' => null
            ]),
            $this->createValidationFactory()
        );
    }

    public function test_it_can_be_optional_with_value()
    {
        $request = new OptionalNestedPropertyRequest(
            $this->createRequest([
                'favorite' => [
                    'first_name' => 'Larry',
                    'last_name'  => 'Johnson',
                    'email'      => 'larry.johnson@gmail.com'
                ],
            ]),
            $this->createValidationFactory()
        );

        $this->assertSame('Larry', $request->favorite->first_name);
        $this->assertSame('Johnson', $request->favorite->last_name);
        $this->assertSame('larry.johnson@gmail.com', $request->favorite->email);

        $this->assertSame($request->favorite->first_name, $request->getRequest()->favorite['first_name']);
        $this->assertSame($request->favorite->last_name, $request->getRequest()->favorite['last_name']);
        $this->assertSame($request->favorite->email, $request->getRequest()->favorite['email']);

        $this->assertInstanceOf(Request::class, $request->getRequest());
    }

    public function test_it_can_be_optional_without_value()
    {
        $request = new OptionalNestedPropertyRequest(
            $this->createRequest([]),
            $this->createValidationFactory()
        );

        $this->assertSame(null, $request->favorite);
        $this->assertInstanceOf(Request::class, $request->getRequest());
    }
*/

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
