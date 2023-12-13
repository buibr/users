<?php

namespace Bi\Users\Factories;

use Illuminate\Support\Str;
use Bi\Users\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = \Bi\Users\Models\User::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ];

        if (config('bi-users.account.enable')) {
            /** @phpstan-ignore-next-line  */
            $data['account_id'] = Account::factory()->create()->id;
        }

        return $data;
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function noAccount(): static
    {
        return $this->state(function (array $attributes) {
            unset($attributes['account_id']);
            return $attributes;
        });
    }
}
