<?php

namespace Raid\Core\Traits\Event;

use Raid\Core\Events\Contracts\EventInterface;

trait WithEventRepository
{
    /**
     * Eventable class name.
     */
    protected string $eventable;

    /**
     * {@inheritdoc}
     */
    public function setEventable(string $eventable): EventInterface
    {
        $this->eventable = $eventable;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function eventable(): string
    {
        return $this->eventable;
    }

    /**
     * {@inheritdoc}
     */
    public function withEventable(): bool
    {
        return isset($this->eventable);
    }
}
