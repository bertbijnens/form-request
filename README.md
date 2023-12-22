# [WIP] Form Request

[![Tests](https://github.com/Anteris-Dev/form-request/actions/workflows/tests.yaml/badge.svg)](https://github.com/Anteris-Dev/form-request/actions/workflows/tests.yaml)
[![Style](https://github.com/Anteris-Dev/form-request/actions/workflows/style.yaml/badge.svg)](https://github.com/Anteris-Dev/form-request/actions/workflows/style.yaml)

Inspired by a [Twitter](https://twitter.com/brendt_gd/status/1409808574860214276?s=21) thread, this is a stab at making Form Request data transfer objects. This package is currently WIP.

## Creating a Form Request
To create your request with validation rules, simply extend `AnterisDev\FormRequest\FormRequestData` and add your public properties. To specify the validation rules for a property, pass a string of Laravel validation rules to the `AnterisDev\FormRequest\Attributes\Validation` attribute.

> **Note**: This package intelligently adds rules like "required" when a property is not nullable and handles adding rules for default PHP types such as "string" for properties that are type hinted as a `string`.

For example:

```php
use AnterisDev\FormRequest\Attributes\Validation;
use AnterisDev\FormRequest\FormRequestData;

class CreatePersonRequest extends FormRequestData
{
    #[Validation('required', 'string', 'max:255')]
    public string $first_name;
    
    #[Validation('required|string|max:255')]
    public string $last_name;
    
    // This property is still required because it is not nullable.
    // This property will also be validated as a string since it has that type. 
    #[Validation('max:255')]
    public string $email;
}
```

Then specify this request in your controller method:

```php
public function store(CreatePersonRequest $request)
{
    die('Hello ' . $request->first_name . ' ' . $request->last_name);
}
```

## Documentation

### Default rules
Based on the type of the property, the following rules get applied automatically:
- `required` when the property does not accept a null vallue and doesn't have a default value
- `nullable` when the property does accept a null value or has a default value
- `string`
- `int`
- `numeric` for float
- `array`
- `boolean`

For example, the following snippet:
```php
class ContactInformation extends FormRequestData
{
    public string $email;
    //generates ['sometimes', 'string'];
    
    public ?string $first_name = null;
    //generates ['sometimes', 'nullable', 'string']
    
    public ?string $last_name;
    //generates ['sometimes', 'nullable', 'string']
    
    public string $role = 'user';
    //generates ['sometimes', 'string']
}
```

### Specify validation rules
You can add any valid Laravel rules via the ```Validation``` attributes.
Provide the validation rules as a string parameter to to the  ```Validation``` object, 
multiple parameters can be passed as multiple arguments

For example, the following snippet:
```php
class CreateUser extends FormRequestData
{
    #[Required, Validation('email')]
    public string $email;
    //generates ['required', 'string', 'email'];
    
    #[Required, Validation('min:1', 'max:20')]
    public string $username;
    //generates ['required', 'string', 'min:1', 'max:20']
    
    #[Required, Validation('password')]
    public string $password;
    //generates ['required', 'string', 'password]
}
```


### Predefined validation rules
Most validation rules are wrapped in predefined attributes.
For example, the following snippet:
```php
class CreateUser extends FormRequestData
{
    #[Email]
    public string $email;
    //generates ['sometimes', 'string', 'email'];
    
    #[Min(1), Max(20)]
    public string $username;
    //generates ['sometimes', 'nullable', 'string', 'min:1', 'max:20']
    
    #[Password]
    public string $password;
    //generates ['sometimes', 'required', 'string', 'password]
}
```

### Multiple validation rules
You can list multiple validation rules
```php
#[Email, Validate('min:1')]
public string $email;
//generates ['sometimes', 'string', 'email', 'min:1];
```



### Create your own validation rules
You can list multiple validation rules
```php
#[Attribute(Attribute::TARGET_PROPERTY)]
class CreativePasswordValidationn implements Rule
{
    public function getRules(): array
    {
        return [
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        ];
    }
}
```

```php
#[CreativePasswordValidation]
public string $password;
//generates ['sometimes', 'string', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'];
```



### Apply validation on arrays
```php
class CreateUser extends FormRequestData
{
    #[Required]
    public string $first_name;
    //generates ['required', 'string''];
    
    #[Required, ValidateArray('string', 'email')]
    public array $list;
    /*generates [
        'list' => 'required'
        'list' => 'array'
        'list.*' => 'string|email|max:255'
    ];
    */
}
```

### Apply validation on objects
```php
class CreateUser extends FormRequestData
{
    #[Required]
    public string $first_name;
    //generates ['required', 'string''];
    
    #[ValidationFor('street', 'required', 'string'), ValidationFor('city', 'required', 'string')]
    public object $address;
    
    /*generates [
        'address.street' => 'required', 'string'
    ];
    */
}
```


### Nested objects
You can nest FormRequestData objects:

```php
class CreateUser extends FormRequestData
{
    #[Required]
    public string $first_name;
    //generates ['required', 'string''];
    
    public CreateAddress $address;
    /*generates [
        'address.street' => 'required', 'string',
        'address.city' => 'required', 'string',
        'address.country_id' => 'required', 'string', 'uuid', 'exists:countries,id'
    ];
    */
}

class CreateAddress extends FormRequestData
{
    #[Required]
    public string $street;
    //generates ['required', 'string'];
    
    #[Required]
    public string $city;
    //generates ['required', 'string']
    
    #[Required, Uuid, Exists('countries', 'id')]
    public string $country_id;
    //generates ['required', 'string', 'uuid', 'exists:countries,id']
}
```

### Nested array of objects
You can nest array of FormRequestData objects:

```php
class ContactList extends FormRequestData
{
    #[Required]
    public string $name;
    //generates ['required', 'string'];
    
    /** @var array<CreateContact> */
    #[ArrayOf(CreateContact::class)]
    public array $contacts;
    /*generates [
        'contacts.*.first_name' => 'required', 'string',
    ];
    */
}

class CreateContact extends FormRequestData
{
    #[Required]
    public string $first_name;
    //generates ['required', 'string''];
}
```

### Email Validation
Due to several options available to the Email validator, the Email validation attribute accepts several flags. These are:

- `Email::RfcValidation`
- `Email::NoRfcWarningsValidation`
- `Email::DnsCheckValidation`
- `Email::SpoofCheckValidation`
- `Email:FilterEmailValidation`

By default, the mode is set to `Email::RfcValidation`.

See an example of this usage below:

```php
class ContactInformation extends FormRequestData
{
    #[Required, Email]
    public string $email;
    
    #[Required, Email(Email::DnsCheckValidation | Email::SpoofCheckValidation)]
    public string $email_2;
}
```


## [WIP] Validation Attributes
To assist with building your validation rules, various attributes are available. These attributes have typed parameters so that it is easy to see their available options.

The following attributes currently exist:

- `Anteris\FormRequest\Attributes\Accepted`
- `Anteris\FormRequest\Attributes\AcceptedIf`
- `Anteris\FormRequest\Attributes\ActiveUrl`
- `Anteris\FormRequest\Attributes\After`
- `Anteris\FormRequest\Attributes\AfterOrEqual`
- `Anteris\FormRequest\Attributes\Alpha`
- `Anteris\FormRequest\Attributes\AlphaNumeric`
- `Anteris\FormRequest\Attributes\AlphaNumericDash`
- `Anteris\FormRequest\Attributes\Bail`
- `Anteris\FormRequest\Attributes\Before`
- `Anteris\FormRequest\Attributes\BeforeOrEqual`
- `Anteris\FormRequest\Attributes\Between`
- `Anteris\FormRequest\Attributes\Boolean`
- `Anteris\FormRequest\Attributes\Confirmed`
- `Anteris\FormRequest\Attributes\CurrentPassword`
- `Anteris\FormRequest\Attributes\Date`
- `Anteris\FormRequest\Attributes\DateEquals`
- `Anteris\FormRequest\Attributes\DateFormat`
- `Anteris\FormRequest\Attributes\Different`
- `Anteris\FormRequest\Attributes\Digits`
- `Anteris\FormRequest\Attributes\DigitsBetween`
- `Anteris\FormRequest\Attributes\Dimensions`
- `Anteris\FormRequest\Attributes\Email`
- `Anteris\FormRequest\Attributes\EndsWith`
- `Anteris\FormRequest\Attributes\ExcludeIf`
- `Anteris\FormRequest\Attributes\ExcludeUnless`
- `Anteris\FormRequest\Attributes\Exists`
- `Anteris\FormRequest\Attributes\File`
- `Anteris\FormRequest\Attributes\Filled`
- `Anteris\FormRequest\Attributes\GreaterThan`
- `Anteris\FormRequest\Attributes\GreaterThanOrEqualTo`
- `Anteris\FormRequest\Attributes\Image`
- `Anteris\FormRequest\Attributes\In`
- `Anteris\FormRequest\Attributes\Integer`
- `Anteris\FormRequest\Attributes\IP`
- `Anteris\FormRequest\Attributes\IPv4`
- `Anteris\FormRequest\Attributes\IPv6`
- `Anteris\FormRequest\Attributes\Json`
- `Anteris\FormRequest\Attributes\LessThan`
- `Anteris\FormRequest\Attributes\LessThanOrEqualTo`
- `Anteris\FormRequest\Attributes\Max`
- `Anteris\FormRequest\Attributes\Mimes`
- `Anteris\FormRequest\Attributes\MimeTypes`
- `Anteris\FormRequest\Attributes\Min`
- `Anteris\FormRequest\Attributes\MultipleOf`
- `Anteris\FormRequest\Attributes\NotIn`
- `Anteris\FormRequest\Attributes\NotRegex`
- `Anteris\FormRequest\Attributes\Nullable`
- `Anteris\FormRequest\Attributes\Numeric`
- `Anteris\FormRequest\Attributes\Password`
- `Anteris\FormRequest\Attributes\PasswordDefaults`
- `Anteris\FormRequest\Attributes\Present`
- `Anteris\FormRequest\Attributes\Prohibited`
- `Anteris\FormRequest\Attributes\ProhibitedIf`
- `Anteris\FormRequest\Attributes\ProhibitedUnless`
- `Anteris\FormRequest\Attributes\Regex`
- `Anteris\FormRequest\Attributes\Required`
- `Anteris\FormRequest\Attributes\RequiredIf`
- `Anteris\FormRequest\Attributes\RequiredUnless`
- `Anteris\FormRequest\Attributes\RequiredWith`
- `Anteris\FormRequest\Attributes\RequiredWithAll`
- `Anteris\FormRequest\Attributes\RequiredWithout`
- `Anteris\FormRequest\Attributes\RequiredWithoutAll`
- `Anteris\FormRequest\Attributes\Same`
- `Anteris\FormRequest\Attributes\Size`
- `Anteris\FormRequest\Attributes\StartsWith`
- `Anteris\FormRequest\Attributes\Timezone`
- `Anteris\FormRequest\Attributes\Url`
- `Anteris\FormRequest\Attributes\Uuid`

To create your own validation attribute, simply extend `Anteris\FormRequest\Attributes\Rule` and provide the correct output to the `getRules()` method.
