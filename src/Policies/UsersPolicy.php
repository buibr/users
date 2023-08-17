<?php

namespace NRB\Users\Policies;

use App\User;
use App\User as AppUser;
use NRB\Users\Enums\RoleEnum;
use NRB\Users\Enums\PermissionEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    public function viewAny(AppUser $user)
    {
        return $user->can(PermissionEnum::USERS_VIEW->value);
    }

    public function view(AppUser $user, AppUser $appUser)
    {
        return $user->can(PermissionEnum::USERS_VIEW->value);
    }

    public function create(AppUser $user)
    {
        return $user->can(PermissionEnum::USERS_CREATE->value);
    }

    public function update(AppUser $user, AppUser $appUser)
    {
        return $appUser->can(PermissionEnum::USERS_UPDATE->value);
    }

    public function delete(AppUser $user, AppUser $appUser)
    {
        return $user->can(PermissionEnum::USERS_DELETE->value);
    }

    public function restore(AppUser $user, AppUser $appUser)
    {
        return $user->can(PermissionEnum::USERS_DELETE->value);
    }

    public function forceDelete(AppUser $user, AppUser $appUser)
    {
        return $user->hasRole(RoleEnum::MASTER->value );
    }
}
