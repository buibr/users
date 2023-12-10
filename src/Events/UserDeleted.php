<?php

namespace Bi\Users\Events;

use Bi\Users\Models\User;
use Illuminate\Queue\SerializesModels;

class UserDeleted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;


    public function __construct(
        public User $user
    ) {
    }
}
