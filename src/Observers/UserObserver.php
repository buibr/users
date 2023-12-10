<?php

namespace Bi\Users\Observers;

use Bi\Users\Models\User;
use Bi\Users\Events\UserCreated;
use Bi\Users\Events\UserUpdated;
use Bi\Users\Events\UserDeleted;
use Illuminate\Support\Facades\Event;

class UserObserver
{
    public function saving(User $model)
    {
        // ...
    }

    public function created(User $user): void
    {
        Event::dispatch(new UserCreated($user));
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
        Event::dispatch(new UserUpdated($user));
    }

    public function deleted(User $user): void
    {
        Event::dispatch(new UserDeleted($user));
    }

    public function restored(User $user): void
    {
        // ...
    }

    public function forceDeleted(User $user): void
    {
        // ...
    }
}
