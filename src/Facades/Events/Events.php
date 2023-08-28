<?php

namespace Raid\Core\Facades\Events;

use Raid\Core\Events\Contracts\EventManagerInterface;
use Raid\Core\Facades\Facade;

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
