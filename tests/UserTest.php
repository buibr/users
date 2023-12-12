<?php

namespace Bi\Users\Tests;

use Bi\Users\Models\User;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends \Orchestra\Testbench\TestCase
{
    use WithWorkbench;
    use RefreshDatabase;

    public function test_user_account_unmounted()
    {
        config(['bi-users' => require 'config/bi-users.php']);
        config(['bi-users.account.enable' => false]);

        $user = User::factory()->create();

        $this->assertNull($user->account);
        $this->assertArrayNotHasKey('account_id',$user->attributesToArray());
    }
}
