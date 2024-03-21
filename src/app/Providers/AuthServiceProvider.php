<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        // ユーザー
        Gate::define('user', function ($user) {
            return $user->role === 'user';
        });

        // 店舗代表者
        Gate::define('shop', function($user){
            return $user->role === 'shop' ;
        });

        // 管理者
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}
