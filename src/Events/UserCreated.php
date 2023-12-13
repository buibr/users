<?php

namespace Bi\Users\Events;

use Bi\Users\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    
    public function __construct(
        public User $user
    ) {
    }
}
