<?php

namespace Bi\Users\Interfaces;

interface RolePermissionsInterface
{
    /** @return PermissionInterface[] */
    public static function permissions(RoleInterface $role): iterable;
}
