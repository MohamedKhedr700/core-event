<?php

namespace Raid\Core\Event\Events\Contracts\Concerns;

interface ActionEventInterface
{
    /**
     * Set action name.
     */
    public function setAction(string $action): static;

    /**
     * Get action name.
     */
    public function action(): string;

    /**
     * Determine if the given action is the same as the current action.
     * If the action is not the same, the eventable will be loaded again.
     */
    public function reloadAction(string $action): void;

    /**
     * Parse action.
     */
    public function parseAction(string $action): array;
}
