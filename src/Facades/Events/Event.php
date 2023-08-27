<?php

namespace Raid\Core\Facades\Events;

use Raid\Core\Facades\Facade;

/**
 * @mixin \Raid\Core\Events\Event
 */
class Event extends Facade
{
    /**
     * {@inheritdoc}
     */
    public const FACADE = 'event';
}
