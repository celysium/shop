<?php

namespace App\Providers;

use App\Repositories\Authentication\AuthenticationRepository;
use App\Repositories\Authentication\AuthenticationRepositoryInterface;
use App\Repositories\OTP\OTPRepository;
use App\Repositories\OTP\OTPRepositoryInterface;
use App\Services\Admin\Authentication\AuthenticationService;
use App\Services\Admin\Authentication\AuthenticationServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }

    public function registerRepositories(): void
    {
        $this->app->bind(AuthenticationRepositoryInterface::class, AuthenticationRepository::class);
        $this->app->bind(OTPRepositoryInterface::class, OTPRepository::class);
    }
}
