# Core Event Package

This package is responsible for handling all events in the system.

## Installation

``` bash
composer require raid/core-event
```

## Configuration

``` bash
php artisan core:publish-event
```


## Usage

``` php
$user = User::create($data);

User::event('create', $user);

// or using the trigger method
User::event()->trigger('create', $user);

// using the facade
Events::trigger('user.create', $user);

// using the helper
events()->trigger('user.create', $user);

```