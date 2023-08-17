<?php

namespace Bi\Users\Interfaces;

use Bi\Users\Enums\RoleEnum;

interface RolePermissionsInterface
{
    public static function permissions(RoleEnum $role): iterable;
}
