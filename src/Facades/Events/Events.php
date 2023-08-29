<?php

namespace Raid\Core\Event\Facades\Events;

use Raid\Core\Event\Events\Contracts\EventManagerInterface;
use Raid\Core\Event\Facades\Facade;

/**
 * @mixin EventManagerInterface
 */
class Events extends Facade
{
    /**
     * {@inheritdoc}
     */
    public const FACADE = 'Events';
}
