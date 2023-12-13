<?php

namespace Anteris\FormRequest\Attributes;

use Anteris\FormRequest\Validators\FakeValidationFactory;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ObjectOf implements Rule
{
    private array $rules;

    public function __construct(string $class)
    {
        $this->rules = $this->generateRulesFor($class);
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    private function generateRulesFor($class): array {

       /*return rules in the following format
        * return [
            'first_name' => ['string'],
            'last_name' => ['string'],
            'email' => ['string', 'email'],
        ];*/

        $type = new $class(
            Request::create('/', 'GET', []),
            new FakeValidationFactory(
            new Translator(
                new ArrayLoader(),
                'en'
            )
        ));

        return $type->getValidationRules();
    }
}
