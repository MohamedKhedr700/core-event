<?php

namespace Raid\Core\Events\Contracts\Concerns;

interface LazyEventInterface
{
    /**
     * Set event lazy load state.
     */
    public function setLazyLoad(bool $lazyLoad): static;

    /**
     * Get event lazy load state.
     */
    public function lazyLoad(): bool;

    /**
     * Set event lazy load state to true.
     */
    public function withLazyLoad(): static;

    /**
     * Set event lazy load state to false.
     */
    public function withoutLazyLoad(): static;
}
