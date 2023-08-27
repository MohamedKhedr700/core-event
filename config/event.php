<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Event Handler
    |--------------------------------------------------------------------------
    | Here you can define the event handler that will be used in the application.
    |
    */

    'event_handler' => Raid\Core\Events\EventManager::class,

    /*
    |--------------------------------------------------------------------------
    | Eventable Handler
    |--------------------------------------------------------------------------
    | Here you can define the eventable handler that will be used in the application.
    |
    */

    'eventable_handler' => Raid\Core\Events\Eventable::class,

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
