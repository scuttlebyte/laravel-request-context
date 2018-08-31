# Store additional contextual data on Laravel Request objects

[![Latest Version on Packagist](https://img.shields.io/packagist/v/scuttlebyte/laravel-request-context.svg?style=flat-square)](https://packagist.org/packages/scuttlebyte/laravel-request-context)
[![Build Status](https://img.shields.io/travis/scuttlebyte/laravel-request-context/master.svg?style=flat-square)](https://travis-ci.org/scuttlebyte/laravel-request-context)
[![Quality Score](https://img.shields.io/scrutinizer/g/scuttlebyte/laravel-request-context.svg?style=flat-square)](https://scrutinizer-ci.com/g/scuttlebyte/laravel-request-context)
[![Total Downloads](https://img.shields.io/packagist/dt/scuttlebyte/laravel-request-context.svg?style=flat-square)](https://packagist.org/packages/scuttlebyte/laravel-request-context)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](LICENSE.md)


This package makes managing contextual data about a request a breeze. It might be helpful to think of Request Contexts
as an alternative to session data, the difference being Request Contexts only persist for the lifespan of the request.

For example, you can retrieve the authenticated `User`'s active `Team` like so:
```php
$currentTeam = Request::context()->get('currentTeam');
```

## Installation

You can install the package via composer:

```bash
composer require scuttlebyte/laravel-request-context
```

Note: Laravel 5.4+ is required.

## Usage

Register context for later use in the request
```php
Request::context()->put('currentTeam', Request::user()->teams->first());
```

Access Request Context by key
```php
$currentTeam = Request::context()->get('currentTeam');
```

Request Contexts don't have to be Eloquent models:

```php
<?php
Request::context()->put('currentTeamTaskCount', Request::user()->teams->first()->tasks->count());

$count = Request::context()->get('currentTeamTaskCount');
// int(10)
```

```php
<?php
Request::context()->put('teamOwner', Request::user()->teams->first()->owner->name);

$owner = Request::context()->get('teamOwner');
// string(14) "Martha Stewart"
```

```php
<?php
Request::context()->put('teamProperties', Request::user()->teams->first()->properties);

$properties = Request::context()->get('teamProperties');
// array(1) {
//   'foo' =>
//   string(3) "bar"
// }
```

The sky is pretty much the limit. You can even pass an array of contexts in:

```php
<?php
Request::context()->put([
    'currentTeamTaskCount' => Request::user()->teams->first()->tasks->count(),
    'teamOwner' => Request::user()->teams->first()->owner->name
]);

$count = Request::context()->get('currentTeamTaskCount');
// int(10)

$owner = Request::context()->get('teamOwner');
// string(14) "Martha Stewart"
```

### Facade & helper

Go ahead, there's no judgement here.

Facade `Context`:
```php
// store it
Context::put('currentTeam', Request::user()->teams->first());

// get it
$currentTeam = Context::get('currentTeam');
```

Helper method `context()`:
```php
// store it
context('currentTeam', request()->user()->teams->first());

// get it
$currentTeam = context('currentTeam');
```

## Where to bind Contexts?

A Middleware is the perfect candidate:

```php
<?php

namespace App\Http\Middleware;

use Closure;

class StoreTeamRequestContext
{
    public function handle($request, Closure $next)
    {
        $request->context()->put('currentTeam', $request->user()->teams()->first());
        return $next($request);
    }
}
```

## But why?

Accessing contextual data through chained Eloquent relationships and helpers leaks implementation details
throughout your application, and often leads to a lot of similar and repeated lines of code.

This package does its best to aid you in the following ways:
- Explicitly binds contextual data in a single location
- Makes refactoring contextual relationships much easier and less risky
- Context values are easily retrieved anywhere you have access to a `Request` object without memorizing chained eloquent relationships

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

### Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jake@scuttlebyte.com instead of using the issue tracker.

## Credits

[Spatie](https://spatie.be/) for their commitment to open source and the Laravel community (and for the [skeleton](https://github.com/spatie/skeleton-php) used to create this package!)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
