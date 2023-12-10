<?php

namespace Bi\Users\Observers;

use Bi\Users\User;

class UserObserver
{
    public function saving(User $model)
    {
        // ...
    }

    public function created(User $channel): void
    {
        // ...
    }

    public function updating(User $user)
    {
        if (array_key_exists('email', $user->getChanges())) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }
    }

    public function updated(User $user): void
    {
        // ...
    }

    public function deleted(User $User): void
    {
        // ...
    }

    public function restored(User $User): void
    {
        // ...
    }

    public function forceDeleted(User $User): void
    {
        // ...
    }
}
