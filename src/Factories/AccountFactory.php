<?php

namespace Bi\Users\Factories;

use NRB\Users\Account;
use NRB\Users\Enums\AccountTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\MidX\Account\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type'      => AccountTypeEnum::USER->name,
            'uuid'      => uuid_create(UUID_TYPE_TIME),
            'full_name' => fake()->name(),
            'username'  => fake()->userName(),
            'active'    => true,
        ];
    }
}
