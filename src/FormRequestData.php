<?php

namespace Anteris\FormRequest;

use Anteris\FormRequest\Attributes\Rule;
use Anteris\FormRequest\Reflection\FormRequestDataReflectionClass;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

abstract class FormRequestData implements Arrayable
{
    private FormRequestDataReflectionClass $reflection;

    final public function __construct(
        private Request $request,
        private Factory $validationFactory
    ) {
        $this->createReflection();
        $this->resolve();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function except(string ...$keys): array
    {
        return array_diff_key($this->toArray(), array_flip($keys));
    }

    public function only(string ...$keys): array
    {
        return array_intersect_key($this->toArray(), array_flip($keys));
    }

    public function toArray(): array
    {
        $reflection = $this->getReflection();
        $array      = [];

        foreach ($reflection->getProperties() as $property) {
            $array[$property->getName()] = $property->getValue($this);
        }

        return $array;
    }

    private function resolve(): void
    {
        $reflection = $this->getReflection();

        $validated = $this->validationFactory->make(
            $this->request->only($reflection->getPropertyNames()),
            $this->getValidationRules()
        )->validate();

        foreach ($validated as $property => $value) {

            //check if property is a FormRequestData class
            foreach($reflection->getProperties() as $property_name) {
                if($property_name->getName() == $property) {
                    foreach($property_name->getTypes() as $type) {
                        if(class_exists($type->getName()) && is_subclass_of($type->getName(), FormRequestData::class)) {
                            $value = new ($type->getName())(
                                Request::create('/', 'GET', $this->request->$property),
                                $this->validationFactory
                            );
                        }
                    }
                }
            }

            $this->{$property} = $value;
        }
    }

    private function createReflection(): void
    {
        $this->reflection = new FormRequestDataReflectionClass($this);
    }

    private function getReflection(): FormRequestDataReflectionClass
    {
        return $this->reflection;
    }

    public function getValidationRules(): array
    {
        return $this->getReflection()->getValidationRules();
    }
}
