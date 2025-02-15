# IPStack

![Build Status](https://github.com/arimolzer/ipstack/actions/workflows/run-tests.yml/badge.svg)
![StyleCI](https://github.styleci.io/repos/924614295/shield)
![Packagist](https://img.shields.io/packagist/dt/arimolzer/ipstack)

This package has been created as a simple facade to access the [IPStack](https://ipstack.com/) API. 

Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Getting started with IPStack is easy, first install the package via Composer:

```bash
composer require arimolzer/ipstack
```

Then, optionally, publish the package configuration. 

```bash
php artisan vendor:publish --provider="Arimolzer\IPStack\IPStackServiceProvider"
```

Then, you can set your environmental variables:

| Variable                   | Description                                                  | Default                  |
|----------------------------|--------------------------------------------------------------|--------------------------| 
| IPSTACK_API_KEY            | API Key For IP Stack                                         | `null`                   |
| IPSTACK_BASE_URI           | Base URL for the API                                         | https://api.ipstack.com/ |
| IPSTACK_DEFAULT_TESTING_IP | The default IP to be used by tests for a successful response | 134.201.250.155          |


## Usage

#### Single IP Lookup
To lookup the geolocation of a single IP address:
```php
use \Arimolzer\IPStack\Facades\IPStack;

IPStack::get('134.201.250.155')
```

#### Bulk IP Address lookup
IP Stack supports bulk IP lookups, with a maximum of 50 addresses. Simply pass through an array of IP addresses to the `getBulk` method. 
> [!IMPORTANT]
> The 'Professional' subscription tier is required to access the bulk endpoint.

```php
IPStack::getBulk(['134.201.250.155' ,'72.229.28.185', '110.174.165.78'])
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

```bash
composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email ari.molzer@molzertech.com instead of using the issue tracker.

## Credits

- [Ari Molzer](https://github.com/arimolzer)
- [All Contributors](https://github.com/arimolzer/ipstack/graphs/contributors)

## License
MIT. Please see the [license file](license.md) for more information.
