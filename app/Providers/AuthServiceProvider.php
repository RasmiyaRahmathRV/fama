<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Throwable;

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

        // NEVER run permission logic during artisan / migrations
        if (app()->runningInConsole()) {
            return;
        }

        try {
            // Extra safety: ensure DB connection exists
            DB::connection()->getPdo();

            if (! Schema::hasTable('permissions')) {
                return;
            }

            $permissions = \App\Models\Permission::pluck('permission_name');

            foreach ($permissions as $perm) {
                Gate::define($perm, function ($user) use ($perm) {
                    return $user->hasPermission($perm);
                });
            }
        } catch (Throwable $e) {
            // Silently ignore DB errors during early boot
            return;
        }
    }
}
