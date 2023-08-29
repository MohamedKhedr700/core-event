<?php

namespace Raid\Core\Event\Events;

use Raid\Core\Event\Events\Contracts\EventInterface;
use Raid\Core\Event\Traits\Event\WithEventResolver;
use Raid\Core\Event\Traits\Event\WithLazyEvent;
use Raid\Core\Event\Traits\Event\WithLoadedEvent;
use Raid\Core\Event\Traits\Event\WithQueueEvent;

abstract class Event implements EventInterface
{
    use WithEventResolver,
        WithLazyEvent,
        WithLoadedEvent,
        WithQueueEvent;

    /**
     * Event action.
     */
    public const ACTION = '';

    /**
     * Event listeners.
     */
    public const LISTENERS = [];

    /**
     * {@inheritdoc}
     */
    public static function action(): string
    {
        return static::ACTION;
    }

    /**
     * {@inheritdoc}
     */
    public static function listeners(): array
    {
        return static::LISTENERS;
    }

    /**
     * {@inheritdoc}
     */
    public function registerInit(array $data): void
    {
        $this->initEvent($data);
        $this->initListeners($data);
    }

    /**
     * {@inheritdoc}
     */
    public function registerHandle(array $data): void
    {
        $this->handleEvent($data);
        $this->handleListeners($data);
    }
}
