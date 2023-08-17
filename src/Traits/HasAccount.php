<?php

namespace NRB\Users\Traits;

use Bi\Users\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAccount
{
    public function initializeHasAccount()
    {
        $this->fillable[] = 'account_id';
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(config('bi-accounts.model'));
    }

}
