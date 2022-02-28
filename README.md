<!-- <p align="center"><img src="/art/logo.svg" alt="Logo Arkye Support"></p> -->

<p align="center">
    <a href="https://github.com/arkye/support/actions">
        <img src="https://github.com/arkye/support/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/arkye/support">
        <img src="https://img.shields.io/packagist/dt/arkye/support" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/arkye/support">
        <img src="https://img.shields.io/packagist/v/arkye/support" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/arkye/support">
        <img src="https://img.shields.io/packagist/l/arkye/support" alt="License">
    </a>
</p>

## Requirements
Is important to know that we use PHP Attributes, so you need to work with PHP versions higher than 8.0

## Install
```terminal
composer require arkye/support
```

## Documentation

<br>

### DataTransferObjects (DTO)


#### Casters
Arkye DataTransferObject extends spatie's implementation ([go to repo](https://github.com/spatie/data-transfer-object)) so check 
their docs if you have any questions or issues not related with addons below.

Arkye implementation has DefaultCast to  \Carbon\Carbon and \Illuminate\Support\Collection, so you don't need to 
do it by yourself on each of your classes.

```php
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Arkye\Support\DataTransferObject\DataTransferObject;

class MyDTO extends DataTransferObject
{
    public Carbon $createdAt;
    public Collection $tags;
}

$dto = new MyDTO(createdAt: '2000-01-01', tags: ['tag1', 'tag2']);
```

We also have an CaseTransformer class attribute to convert key case on the DTO creation or transformation.
This is useful when working with apis, sometimes we use snake case with external communication, 
but camel case on our internal code.<br><br>
First argument of transformer specifies the DTO properties case, and second 
the case when converting into array or json.

```php
use Arkye\Support\DataTransferObject\Attributes\CaseTransformer;
use Arkye\Support\DataTransferObject\DataTransferObject;
use Carbon\Carbon;

#[CaseTransformer('camel', 'snake')]
class MyDTO extends DataTransferObject
{
    public Carbon $createdAt;
    public string $fullName;
}

// Request came with created_at and full_name
$dto = new MyDTO(request()->all());

// Do some work with DTO...

// Will be converted to snake case again
response()->json($dto->toArray());
```

## Contributing

Thank you for considering contributing to Arkye! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## Code of Conduct

Please review and abide by the [Code of Conduct](.github/CODE_OF_CONDUCT.md).

## License

Arkye Support is open-sourced software licensed under the [MIT license](LICENSE.md).
