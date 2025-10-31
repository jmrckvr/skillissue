<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;

class ReactionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        User::macro('hasReacted', function ($reactable) {
            return $reactable->reactions()
                ->where('user_id', $this->id)
                ->exists();
        });
    }
}
