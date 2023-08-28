<?php

namespace Raid\Core\Traits\Event;

use Raid\Core\Events\Contracts\EventableInterface;

trait WithActionEvent
{
    /**
     * Action name.
     */
    protected string $action;

    /**
     * {@inheritdoc}
     */
    public function setAction(string $action): static
    {
        $this->reloadAction($action);

        $this->action = $action;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function action(): string
    {
        return $this->action;
    }

    /**
     * {@inheritdoc}
     */
    public function reloadAction(string $action): void
    {
        if (! isset($this->action) || $this->action() === $action) {
            return;
        }

        $this->loaded = false;
    }

    /**
     * {@inheritdoc}
     */
    public function parseAction(string $action): array
    {
        return array_values(array_filter(explode(' ', $action)));
    }
}