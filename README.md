# Web Application Firewall for Laravel

## Installation

You can install the package via composer:

```bash
composer require NashChat/laravel-waf
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-waf-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-waf-config"
```

This is the contents of the published config file:

```php
return [

    'filters' => [
    
        \Albert\Waf\Filters\ResourceEnumerationFilter::class,

    ]

];
```

## Usage

Laravel Waf comes with a Middleware that will handle banned IPs.
On Laravel 11, you can setup it on `bootstra/app.php`:

```php
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(WafMiddleware::class);
    })
    ->create();
```

If you want to ban an IP addess, you can do it like so:

```php
use Albert\Waf\Facades\Waf;
use Illuminate\Support\Carbon;

Waf::banIpUntil('1.1.1.1', Carbon::tomorrow());
```

## Filters

Laravel Waf comes with a preset of filters to apply on the incomming request. All enabled filters are defined on the config file.
You can create new filters that validates the incomming request. It is a simple class that needs to implement the ValidatesReques interface:

```php
<?php

namespace App\Waf\Filters;

use Albert\Waf\Contracts\ValidatesRequest;
use Illuminate\Http\Request;

class DenyAllRequestsFilter implements ValidatesRequest
{
    public function requestIsValid(Request $request): bool
    {
        return false;
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [nachash]([](https://github.com/NashChat))
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
