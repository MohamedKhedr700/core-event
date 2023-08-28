<?php

namespace Raid\Core\Traits\Event;

use Raid\Core\Events\Contracts\EventableInterface;

trait WithEventable
{
    /**
     * Eventable class name.
     */
    protected string $eventable;

    /**
     * Eventable response instance.
     */
    protected EventableInterface $eventableResponse;

    /**
     * {@inheritdoc}
     */
    public function setEventable(string $eventable): static
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
    public function setEventableResponse(EventableInterface $eventableResponse): void
    {
        $this->eventableResponse = $eventableResponse;
    }

    /**
     * {@inheritdoc}
     */
    public function response(): EventableInterface
    {
        return $this->eventableResponse;
    }

    /**
     * {@inheritdoc}
     */
    public function withEventable(): bool
    {
        return isset($this->eventable);
    }
}
