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
use Raid\Core\Event\Traits\Event\Eventable;

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

Now, let's create our event class `CreateUserEvent`.

you can use the command `php artisan core:make-event CreateUserEvent` to create the event class.

``` php
<?php

namespace App\Events;

use Raid\Core\Event\Events\Contracts\EventInterface;
use Raid\Core\Event\Events\Event;

class CreateUserEvent extends Event implements EventInterface
{
    /**
     * {@inheritdoc}
     */
    public const ACTION = '';

    /**
     * {@inheritdoc}
     */
    public const LISTENERS = [];
}
```

The event class must implement `EventInterface` interface.

The event class must extend `Event` class.

The event class must define `ACTION` constant, which is the event action name.

The `LISTENERS` constant is an array of listener classes that will be called when the event is triggered.

Now, let's create our event listener `CreateUserListener`.

you can use the command `php artisan core:make-listener CreateUserListener` to create the event listener class.

``` php
<?php

namespace App\Listeners;

use Raid\Core\Event\Events\Contracts\EventListenerInterface;

class CreateUserListener implements EventListenerInterface
{
    /**
     * Initialize the listener.
     */
    public function init(): void
    {
    }

    /**
     * Handle the listener.
     */
    public function handle(): void
    {
    }
}
```

The event listener class must implement `EventListenerInterface` interface.

The `init` method is the method that will be called when the event listener is initialized.

The `handle` method is the method that will be called when the event is triggered.

Let's finish our event class and listener class.

``` php
<?php

namespace App\Events;

use Raid\Core\Event\Events\Contracts\EventInterface;
use Raid\Core\Event\Events\Event;

class CreateUserEvent extends Event implements EventInterface
{
    /**
     * {@inheritdoc}
     */
    public const ACTION = 'create';

    /**
     * {@inheritdoc}
     */
    public const LISTENERS = [
        CreateUserListener::class,
    ];
}
```

``` php
<?php

namespace App\Listeners;

use App\Models\User;
use Raid\Core\Event\Events\Contracts\EventListenerInterface;

class CreateUserListener implements EventListenerInterface
{
    /**
     * Handle the listener.
     */
    public function handle(User $user): void
    {
    }
}
```

Now, let's trigger the event.

``` php
$user = User::create($data);

User::events()->trigger('create', $user);
```

The `events` method is a static method that will be called from the `Eventable` trait.

The `trigger` method is a method that will be called from the `Events` and `Listener` related to the fired action.

This will call the `handle` method in each listener related to the fired event action.

And that's it.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [Mohamed Khedr]()

## Security

If you discover any security-related issues, please email
instead of using the issue tracker.

## About Raid

Raid is a PHP framework created by [MohamedKhedr700]()
and is maintained by [MohamedKhedr700]().

## Support Raid

Raid is an MIT-licensed open-source project. It's an independent project with its ongoing development made possible.

