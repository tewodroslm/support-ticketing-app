<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        //Define Scope
        Passport::tokensCan([
            'admin' => 'Add/Edit/Delete Users',
            'Ar1' => 'Edit Users',
            'Ar2' => 'Edit Users',
            'basic' => 'List Users'
        ]);
        Passport::routes();
    }
}
