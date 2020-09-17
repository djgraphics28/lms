<?php

namespace App\Providers;

// -*- Add as GateContract
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isSuperAdmin', function ($user) {
            return $user->user_type == 1;
        });

        $gate->define('isAdmin', function ($user) {
            return $user->user_type == 2;
        });

        $gate->define('isManager', function ($user) {
            return $user->user_type == 3;
        });

        $gate->define('isSupervisor', function ($user) {
            return $user->user_type == 4;
        });

        $gate->define('isUser', function ($user) {
            return $user->user_type == 5;
        });
    }
}
