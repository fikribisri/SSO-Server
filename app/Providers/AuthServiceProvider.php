<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        // this token lifetime
        // Passport::tokensExpireIn(now()->addDays(15));
        Passport::tokensExpireIn(now()->addHours(8));
        Passport::refreshTokensExpireIn(now()->addMinutes(5));

        //custom authorization routes
        \Route::get('oauth/authorize', [
            'uses' => '\App\Http\Controllers\CustomOauthAuthorizationController@authorize',
        ])->middleware(['web', 'auth']);
    }
}
