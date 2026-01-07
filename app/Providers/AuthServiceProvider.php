<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Dynamically register all permissions from DB
        if (Schema::hasTable('permissions')) {  // Prevent error before migration
            $permissions = Permission::pluck('permission_name');

            foreach ($permissions as $perm) {
                Gate::define($perm, function ($user) use ($perm) {
                    return $user->hasPermission($perm);
                });
            }
        }
    }
}
