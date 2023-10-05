<?php

namespace Raid\Core\Event\Facades;

use Raid\Core\Event\Events\Contracts\EventManagerInterface;

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
