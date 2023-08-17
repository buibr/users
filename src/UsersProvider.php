<?php

namespace Bi\Users;

use Bi\Users\Commands\UserRoleReset;
use Bi\Users\Observers\UserObserver;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Bi\Users\Observers\AccountObserver;

class UsersProvider extends ServiceProvider
{
    public function boot(Filesystem $filesystem)
    {
        if (function_exists('config_path')) { // function not available and 'publish' not relevant in Lumen
            $this->publishes([
                __DIR__ . '/../config/bi-users.php' => config_path('bi-users.php'),
                __DIR__ . '/../config/bi-accounts.php' => config_path('bi-accounts.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../migrations/' => database_path('/migrations/bi-user/'),
            ], 'migrations');
        }

        $this->commands([
            UserRoleReset::class,
        ]);

    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/bi-users.php', 'bi-users');
        $this->mergeConfigFrom(__DIR__ . '/../config/bi-accounts.php', 'bi-accounts');
    }

    private function bootObservers(): void
    {
        User::observe(UserObserver::class);
        Account::observe(AccountObserver::class);
    }
}
