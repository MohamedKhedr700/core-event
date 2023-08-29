<?php

namespace Raid\Core\Traits\Event;

use Raid\Core\Events\Contracts\EventableInterface;

trait WithEventableResponse
{
    /**
     * Eventable response instance.
     */
    protected EventableInterface $eventableResponse;

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
}
