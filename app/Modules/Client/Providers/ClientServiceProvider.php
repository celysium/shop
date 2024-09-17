<?php

namespace App\Modules\Client\Providers;

use App\Modules\Client\Services\Authentication\AuthenticationService;
use App\Modules\Client\Services\Authentication\AuthenticationServiceInterface;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
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
