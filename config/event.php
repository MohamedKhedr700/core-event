<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Events Manager
    |--------------------------------------------------------------------------
    | Here you can define the events manager that will be used in the application.
    |
    */

    'events_manager' => Raid\Core\Event\Events\EventManager::class,

    /*
    |--------------------------------------------------------------------------
    | Eventable Manager
    |--------------------------------------------------------------------------
    | Here you can define the eventable manager that will be used in the application.
    |
    */

    'eventable_manager' => Raid\Core\Event\Events\Eventable::class,

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    | Here you can define the events that will be used in the application.
    | The events must be defined in the following format:
    | eventable::class => [
    |     event::class,
    | ],
    |
    */

    'events' => [],
];
