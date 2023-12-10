<?php

namespace Bi\Users\Factories;

use Bi\Users\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'type'      => \Bi\Users\Enums\AccountTypeEnum::USER->name,
            'uuid'      => uuid_create(UUID_TYPE_TIME),
            'full_name' => fake()->name(),
            'username'  => fake()->userName(),
            'active'    => true,
        ];
    }
}
