<?php

namespace App\Modules\Admin\Providers;

use App\Modules\Admin\Services\Authentication\AuthenticationService;
use App\Modules\Admin\Services\Authentication\AuthenticationServiceInterface;
use Illuminate\Support\ServiceProvider;

class AminServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }
}
