<?php

namespace Anteris\FormRequest\Reflection;

use Anteris\FormRequest\FormRequestData;
use ReflectionClass;
use ReflectionProperty;

class FormRequestDataReflectionClass
{
    private FormRequestData $formRequest;

    private ReflectionClass $formRequestReflection;

    public function __construct(FormRequestData $formRequest)
    {
        $this->formRequest           = $formRequest;
        $this->formRequestReflection = new ReflectionClass($formRequest);
    }

    public function getProperties(): array
    {
        $publicProperties = array_filter(
            $this->formRequestReflection->getProperties(
                ReflectionProperty::IS_PUBLIC
            ),
            fn ($property) => ! $property->isStatic()
        );

        return array_map(
            fn ($property) => new FormRequestDataReflectionProperty($property),
            $publicProperties
        );
    }

    public function getPropertyNames(): array
    {
        return array_map(
            fn ($property): string => $property->getName(),
            $this->getProperties()
        );
    }

    public function getValidationRules(): array
    {
        $build = [];

        /** @var FormRequestDataReflectionProperty $property */
        foreach ($this->getProperties() as $property) {
            $validation_rules = $property->getValidationRules();

            foreach($validation_rules as $k => $v) {
                if(is_numeric($k)) {
                    $build[$property->getName()] = array_unique(array_merge(
                        $build[$property->getName()] ?? [],
                        [$v]
                    ));
                }
                else {
                    $build[$property->getName() . '.*.' . $k] = array_unique(array_merge(
                        $build[$property->getName() . '.*.' . $k] ?? [],
                        $v
                    ));
                }
            }
        }

        return $build;
    }
}
