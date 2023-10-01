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

User::events('create', $user);

// or using the trigger method
User::events()->trigger('create', $user);

// using the facade
Events::trigger('user.create', $user);

// using the helper
events()->trigger('user.create', $user);

```

# How to work this

Let's start with our eventable class `User`.

``` php

class User
{
    use Eventable;
}

```

To define the `User` class events, we have two ways:

1. Using `getEvents` method.

``` php

class User
{
    use Eventable;
    
    **
     * Get eventable events.
     */
    public static function getEvents(): array
    {
        return [
            // here we define our event classes.
            CreateUserEvent::class,
        ];
    }
}

```

2. Using `config/event.php` file in `events` key.

``` php

'events' => [
    // here we define our eventable class.
    User::class => [
        // here we define our event classes.
        CreateUserEvent::class,
    ],
],
    
```