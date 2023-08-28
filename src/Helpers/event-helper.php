<?php

use Raid\Core\Events\Contracts\EventableInterface;
use Raid\Core\Events\Contracts\EventManagerInterface;
use Raid\Core\Facades\Events\Event;

if (! function_exists('events')) {
    /**
     * Get event manager instance.
     */
    function events(string $eventable = '', string $action = '', array $data = []): EventManagerInterface
    {
        $eventManager = Event::getFacadeRoot();

        if ($eventable) {
            $eventManager->setEventable($eventable);
        }

        if ($action && $data) {
            $eventManager->trigger($action, ...$data);
        }

        return $eventManager;
    }
}

if (! function_exists('eventable')) {
    /**
     * Get eventable instance.
     */
    function eventable(string $eventable = '', string $action = '', array $data = []): EventableInterface
    {
        $eventableManager = app(EventableInterface::class, ['eventable' => $eventable]);

        if ($action) {
            $eventableManager->setAction($action);
        }

        if ($data) {
            $eventableManager->trigger($action, ...$data);
        }

        return $eventableManager;
    }
}

if (! function_exists('concat_actions')) {
    /**
     * Concatenate actions.
     */
    function concat_actions(...$actions): string
    {
        return implode(' ', $actions);
    }
}
