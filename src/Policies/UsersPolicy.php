<?php

namespace NRB\Users\Policies;

use Bi\Users\Models\User;
use Bi\Users\Enums\RoleEnum;
use Bi\Users\Enums\PermissionEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can(PermissionEnum::USERS_VIEW->value);
    }

    public function view(User $user, User $appUser)
    {
        return $user->can(PermissionEnum::USERS_VIEW->value);
    }

    public function create(User $user)
    {
        return $user->can(PermissionEnum::USERS_CREATE->value);
    }

    public function update(User $user, User $appUser)
    {
        return $appUser->can(PermissionEnum::USERS_UPDATE->value);
    }

    public function delete(User $user, User $appUser)
    {
        return $user->can(PermissionEnum::USERS_DELETE->value);
    }

    public function restore(User $user, User $appUser)
    {
        return $user->can(PermissionEnum::USERS_DELETE->value);
    }

    public function forceDelete(User $user, User $appUser)
    {
        return $user->hasRole(RoleEnum::MASTER->value );
    }
}
