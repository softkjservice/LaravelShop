<?php

namespace App\Providers;

use App\Enums\UserRole;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

       /* Gate::define('isAdmin', function (User $user){
           return  $user->role == UserRole::ADMIN;
        });
        Gate::define('isUser', function (User $user){
            return  $user->role == UserRole::USER;
        });*/

        $this->defineUserRoleGate('isAdmin', UserRole::ADMIN);
        $this->defineUserRoleGate('isUser', UserRole::USER);
    }
/*
    private function defineUserRoleGate(string $name, string $role): void
    {
        Gate::define($name, function (User $user) use ($role){
            return $user->role == $role;
        });
    }*/

    private function defineUserRoleGate(string $name, string $role): void
    {
        Gate::define($name, function(User $user) use ($role) {
            return $user->role == $role;
        });
    }
}
