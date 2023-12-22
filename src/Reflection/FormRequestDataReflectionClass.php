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

    public function getProperty(string $name): ?FormRequestDataReflectionProperty
    {
        foreach ($this->getProperties() as $property) {
            if ($property->getName() == $name) {
                return $property;
            }
        }

        return null;
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
                $validation_subject = $property->getName();

                foreach($property->getTypes() as $type) {
                    //var_dump($type->getName());
                }

                if(is_string($k)) {
                    if($property->hasType('array')) {
                        $validation_subject = trim($validation_subject . '.*.' . $k, '.');
                    }
                    else if($property->hasType('object')) {
                        $validation_subject = trim($validation_subject . '.' . $k, '.');
                    }
                }

                $rule = $v;
                if(is_numeric($k)) {
                    $rule = [$v];
                }

                $build[$validation_subject] = $this->removeDuplicateRules(array_merge(
                    $build[$validation_subject] ?? [],
                    $rule
                ));
            }
        }

        return $build;
    }

    private function removeDuplicateRules(array $rules): array {
        if(in_array('required', $rules) && in_array('sometimes', $rules)) {
            $rules = array_filter($rules, function($rule) {
                return $rule != 'sometimes';
            });
        }

        return array_unique($rules);
    }
}
