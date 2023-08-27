<?php

namespace Raid\Core\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
    /**
     * Facade bind key.
     */
    public const FACADE = '';

    /**
     * Get the facade bind key.
     */
    public static function facade(): string
    {
        return static::FACADE;
    }

    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return static::facade();
    }
}
