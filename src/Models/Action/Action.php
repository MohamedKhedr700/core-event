<?php

namespace Raid\Core\Models\Action;

use Raid\Core\Traits\Action\Enum\WithAuthAction;
use Raid\Core\Traits\Action\Enum\WithCrudAction;
use Raid\Core\Traits\Action\Enum\WithProfileAction;
use Raid\Core\Traits\Enum\ConstEnum;

class Action
{
    use ConstEnum,
        WithAuthAction,
        WithCrudAction,
        WithProfileAction;
}
