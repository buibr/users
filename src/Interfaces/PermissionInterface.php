<?php

namespace Bi\Users\Interfaces;

use Bi\Users\Enums\RoleEnum;
use Spatie\Permission\Models\Permission;

interface PermissionInterface
{
    public function getObject() : mixed;
}
