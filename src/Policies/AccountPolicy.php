<?php

namespace NRB\Users\Policies;

use Bi\Users\Models\Account;
use Bi\Users\Enums\RoleEnum;
use Bi\Users\Enums\PermissionEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function viewAny(Account $user)
    {
        return $user->can(PermissionEnum::MASTER_VIEW->value);
    }

    public function view(Account $user, Account $appUser)
    {
        return $user->can(PermissionEnum::MASTER_VIEW->value);
    }

    public function create(Account $user)
    {
        return $user->can(PermissionEnum::MASTER_CREATE->value);
    }

    public function update(Account $user, Account $appUser)
    {
        return $appUser->can(PermissionEnum::MASTER_UPDATE->value);
    }

    public function delete(Account $user, Account $appUser)
    {
        return $user->can(PermissionEnum::MASTER_DELETE->value);
    }

    public function restore(Account $user, Account $appUser)
    {
        return $user->can(PermissionEnum::MASTER_DELETE->value);
    }

    public function forceDelete(Account $user, Account $appUser)
    {
        return $user->hasRole(RoleEnum::MASTER->value);
    }
}
