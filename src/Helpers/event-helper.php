<?php

use Raid\Core\Event\Events\Contracts\EventableInterface;
use Raid\Core\Event\Events\Contracts\EventManagerInterface;
use Raid\Core\Event\Facades\Events\Events;

if (! function_exists('events')) {
    /**
     * Get events facade instance.
     */
    function events(string $eventable = '', string $action = '', array $data = []): EventManagerInterface
    {
        $eventManager = Events::getFacadeRoot();

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