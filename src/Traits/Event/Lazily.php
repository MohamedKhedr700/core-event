<?php

namespace Raid\Core\Event\Traits\Event;

trait Lazily
{
    /**
     * Indicates if the event should be lazy loaded.
     */
    private static bool $lazy = true;

    /**
     * Set the event lazy load.
     */
    public function setLazy(bool $lazy): static
    {
        static::$lazy = $lazy;

        return $this;
    }

    /**
     * Determine if the event should be lazily loaded.
     */
    public static function lazy(): bool
    {
        return static::$lazy;
    }
}
