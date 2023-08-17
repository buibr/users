<?php

namespace Bi\Users\Commands;

use Bi\Users\User;
use Illuminate\Console\Command;

class UserRoleReset extends Command
{
    protected $signature = 'bi:user:reset-role
                {user : Username or id or email} 
                {role : The role to be attached}';

    protected $description = 'Reset role for specified user';

    public function handle()
    {
        $userIdentifier = $this->argument('user');
        $role = $this->argument('role');

        /** @var User $user */
        $user = User::where('id', $userIdentifier)->orWhere('email', $userIdentifier)->first();

        if ($user) {
            $user->syncRoles($role);
        }

        return Command::SUCCESS;
    }
}
