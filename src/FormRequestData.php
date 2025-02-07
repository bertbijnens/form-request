<?php

namespace Anteris\FormRequest;

use Anteris\FormRequest\Attributes\ArrayOf;
use Anteris\FormRequest\Reflection\FormRequestDataReflectionClass;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

abstract class FormRequestData implements Arrayable
{
    private FormRequestDataReflectionClass $reflection;

    protected array $validated = [];

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

    public function validated(): array
    {
        return $this->validated;
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

        $this->validated = $this->validationFactory->make(
            $this->request->only($reflection->getPropertyNames()),
            $this->getValidationRules()
        )->validate();

        foreach ($this->validated as $property => $value) {

            $property_reflection = $reflection->getProperty($property);

            //check if property is a FormRequestData class
            foreach($property_reflection->getTypes() as $type) {
                if(class_exists($type->getName()) && is_subclass_of($type->getName(), FormRequestData::class)) {
                    $value = new ($type->getName())(
                        Request::create('/', 'GET', $this->request->$property),
                        $this->validationFactory
                    );
                }
            }

            if($this->request->$property && $property_reflection->hasType('array')) {
                $array_attribute = $property_reflection->firstValidationAttribute(ArrayOf::class);

                if($array_attribute) {
                    $dto_type = $array_attribute->getArguments()[0];

                    $value = array_map(function($item) use ($dto_type) {
                        return new ($dto_type)(
                            Request::create('/', 'GET', $item),
                            $this->validationFactory
                        );
                    }, $this->request->$property);
                }
            }

            if($property_reflection->hasType('object') && is_array($value)) {
                $value = (object)$value;
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
