<?php

namespace NRB\Users\Traits;

use Bi\Users\Models\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Account $account
 */
trait HasAccount
{
    public function initializeHasAccount()
    {
        $this->fillable[] = 'account_id';
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(config('bi-users.account.model'));
    }

}
