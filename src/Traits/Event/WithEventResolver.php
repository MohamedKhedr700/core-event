<?php

namespace Raid\Core\Traits\Event;

use Illuminate\Support\Facades\App;
use Raid\Core\Events\Contracts\EventListenerInterface;

trait WithEventResolver
{
    /**
     * Event loaded listeners.
     */
    protected array $loadedListeners = [];

    /**
     * Indicates if event listeners are loaded.
     */
    protected bool $loaded = false;

    /**
     * {@inheritdoc}
     */
    public function setLoadedListeners(array $loadedListeners): void
    {
        $this->loadedListeners = $loadedListeners;
    }

    /**
     * {@inheritdoc}
     */
    public function loadedListeners(): array
    {
        return $this->loadedListeners;
    }

    /**
     * {@inheritdoc}
     */
    public function loaded(): bool
    {
        return $this->loaded;
    }

    /**
     * {@inheritdoc}
     */
    public function loadListeners(bool $lazyLoad = true): array
    {
        if ($this->loaded()) {
            return $this->loadedListeners();
        }

        $listeners = static::listeners();

        $loadedListeners = [];

        foreach ($listeners as $listener) {
            if ($lazyLoad && $this->lazilyListener($listener)) {
                continue;
            }

            $loadedListeners[] = App::make($listener);
        }

        $this->setLoadedListeners($loadedListeners);

        $this->loaded = true;

        return $loadedListeners;
    }

    /**
     * {@inheritdoc}
     */
    public function initEvent(array $data): void
    {
        if (! method_exists($this, 'init')) {
            return;
        }

        if ($this->queueableEvent()) {

            $this->dispatchEventManager('init', $data);

            return;
        }

        $this->init(...$data);
    }

    /**
     * {@inheritdoc}
     */
    public function initListeners(array $data): void
    {
        $listeners = $this->loadListeners();

        foreach ($listeners as $listener) {
            $this->initListener($listener, $data);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function initListener(EventListenerInterface $listener, array $data): void
    {
        if (! method_exists($listener, 'init')) {
            return;
        }

        if ($this->queueableListener($listener)) {

            $this->dispatchEventListener($listener, 'init', $data);

            return;
        }

        $listener->init(...$data);
    }

    /**
     * {@inheritdoc}
     */
    public function handleEvent(array $data): void
    {
        if (! method_exists($this, 'handle')) {
            return;
        }

        if ($this->queueableEvent()) {

            $this->dispatchEventManager('handle', $data);

            return;
        }

        $this->handle(...$data);
    }

    /**
     * {@inheritdoc}
     */
    public function handleListeners(array $data): void
    {
        $listeners = $this->loadListeners();

        foreach ($listeners as $listener) {
            $this->handleListener($listener, $data);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function handleListener(EventListenerInterface $listener, array $data): void
    {
        if (! method_exists($listener, 'handle')) {
            return;
        }

        if ($this->queueableListener($listener)) {

            $this->dispatchEventListener($listener, 'handle', $data);

            return;
        }

        $listener->handle(...$data);
    }
}
