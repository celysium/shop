<?php

namespace App\Modules\Admin\Providers;

use App\Modules\Admin\Services\Admin\Authentication\AuthenticationService;
use App\Modules\Admin\Services\Admin\Authentication\AuthenticationServiceInterface;
use App\Modules\Core\Models\Cart;
use App\Modules\Core\Observers\CartObserver;
use App\Modules\Core\Repositories\OTP\OTPRepository;
use App\Modules\Core\Repositories\OTP\OTPRepositoryInterface;
use App\Modules\Core\Repositories\User\UserRepository;
use App\Modules\Core\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AminServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OTPRepositoryInterface::class, OTPRepository::class);
    }

    public function registerObserver()
    {
        Cart::observe(CartObserver::class);
    }
}
