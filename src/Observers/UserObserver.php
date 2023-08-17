<?php

namespace Bi\Users\Observers;

use Bi\Users\Account;

class UserObserver
{
    public function saving(Account $model)
    {
        if (!$model->uuid) {
            $model->uuid = uuid_create();
        }
    }

    /**
     * Handle the Account "created" event.
     */
    public function created(Account $channel): void
    {
    }

    /**
     * Handle the Account "updated" event.
     */
    public function updated(Account $channel): void
    {
        // ...
    }

    /**
     * Handle the Account "deleted" event.
     */
    public function deleted(Account $channel): void
    {
        // ...
    }

    /**
     * Handle the Account "restored" event.
     */
    public function restored(Account $channel): void
    {
        // ...
    }

    /**
     * Handle the Account "forceDeleted" event.
     */
    public function forceDeleted(Account $channel): void
    {
        // ...
    }
}
