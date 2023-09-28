<?php

namespace Raid\Core\Event\Commands;

use Raid\Core\Command\Commands\PublishCommand as CorePublishCommand;
class PublishCommand extends CorePublishCommand
{
    /**
     * {@inheritdoc}
     */
    protected $signature = 'core:publish-event';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Publish core event config files.';

    /**
     * {@inheritdoc}
     */
    public function handle(): void
    {
        $this->publish('config-event');
    }
}
