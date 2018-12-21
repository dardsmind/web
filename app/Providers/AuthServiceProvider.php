<?php

namespace App\Providers;

use App\Extensions\AccessTokenGuard;
use App\Extensions\TokenToUserProvider;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Auth;

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
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

		Auth::extend('access_token', function ($app, $name, array $config) {
			$userProvider = app(TokenToUserProvider::class);
			$request = app('request');
			return new AccessTokenGuard($userProvider, $request, $config);
		});		
		
		
    }
}
