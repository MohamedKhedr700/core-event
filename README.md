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

The event class must define `ACTION` constant, which is the event action name.

The event class must define `LISTENERS` constant, which is the event listeners,
which will be called when the event is triggered.

Now, let's create our event listener `CreateUserListener`.

you can use the command `php artisan core:make-listener CreateUserListener` to create the event listener class.

``` php
<?php

namespace App\Listeners;

use Raid\Core\Event\Events\Contracts\EventListenerInterface;

class TestListener implements EventListenerInterface
{
    /**
     * Initialize the listener.
     */
    public function init(): void
    {
    }

    /**
     * Handle the Initialize the listener.
     */
    public function handle(): void
    {
    }
}
```

The event listener class must implement `EventListenerInterface` interface.

The `handle` method is the method that will be called when the event is triggered.

The `init` method is the method that will be called when the event listener is initialized.

And that's it.

Now, let's trigger the event.

Add the proper action and listeners to the event class.

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

Now, let's trigger the event.

``` php
class UserController extends Controller
{
    /**
     * Invoke the controller method.
     */
    public function __invoke(Request $request, CreateUserAction $action)
    {
        $action->execute($request->only(['name', 'email', 'password']));
    
        // or using the static call
        CreateUserAction::exec($request->only(['name', 'email', 'password']));
    }
}
```

Now, let's create our action class `CreateUserAction`.

you can use the command `php artisan core:make-action CreateUserAction` to create the action class.

``` php
<?php

namespace App\Actions;

use Raid\Core\Action\Actions\Contracts\ActionInterface;
use Raid\Core\Action\Actions\Action;

class TestAction extends Action implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public const ACTION = '';

    /**
     * {@inheritDoc}
     */
    public const ACTIONABLE = '';

    /**
     * Handle the action.
     */
    public function handle()
    {
    }
}
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [Mohamed Khedr]

## Security

If you discover any security-related issues, please email
instead of using the issue tracker.

## About Raid

Raid is a PHP framework created by [Mohamed Khedr]
and is maintained by [Mohamed Khedr].

## Support Raid

Raid is an MIT-licensed open-source project. It's an independent project with its ongoing development made possible.

