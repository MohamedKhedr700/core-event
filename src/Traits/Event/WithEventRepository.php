<?php

namespace Raid\Core\Traits\Event;

use Raid\Core\Events\Contracts\EventInterface;

trait WithEventRepository
{
    /**
     * Repository name.
     */
    protected string $repository;

    /**
     * {@inheritdoc}
     */
    public function setRepository(string $repository): EventInterface
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function repository(): string
    {
        return $this->repository;
    }

    /**
     * {@inheritdoc}
     */
    public function withRepository(): bool
    {
        return isset($this->repository);
    }
}
