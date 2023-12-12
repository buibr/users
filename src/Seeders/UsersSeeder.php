<?php

namespace NRB\Users\Seeders;

use Bi\Users\Models\User;
use Bi\Users\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate([
            'email' => 'bi@nrb.company',
        ], [
            'name'              => 'Burhan Ibrahimi',
            'email_verified_at' => now(),
            'password'          => Hash::make('Aa123@321'),
        ]);

        $user->assignRole(RoleEnum::MASTER->value);
    }
}
