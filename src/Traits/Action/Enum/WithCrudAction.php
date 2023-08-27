<?php

namespace Raid\Core\Traits\Action\Enum;

trait WithCrudAction
{
    const CREATE = 'create';

    const LIST = 'list';

    const FIND = 'find';

    const FIND_BY = 'find_by';

    const UPDATE = 'update';

    const PATCH = 'patch';

    const DELETE = 'delete';

    const FORCE_DELETE = 'force_delete';

    const RESTORE = 'restore';
}
