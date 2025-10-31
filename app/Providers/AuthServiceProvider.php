<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        // Admin gates
        Gate::define('manage-users', fn($user) => $user->role === 'admin');
        Gate::define('approve-jobs', fn($user) => $user->role === 'admin');
        Gate::define('moderate-forum', fn($user) => in_array($user->role, ['admin', 'employer']));

        // Employer gates
        Gate::define('manage-company', fn($user, $company) => $user->id === $company->employer_id);
        Gate::define('manage-jobs', function ($user, $company) {
            return $user->role === 'employer' && $user->companies->contains($company);
        });

        // Applicant gates
        Gate::define('apply-jobs', fn($user) => $user->role === 'applicant');
    }
}
