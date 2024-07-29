<?php

namespace App\Modules\Core\Providers;

use App\Modules\Core\Models\Cart;
use App\Modules\Core\Observers\CartObserver;
use App\Modules\Core\Repositories\OTP\OTPRepository;
use App\Modules\Core\Repositories\OTP\OTPRepositoryInterface;
use App\Modules\Core\Repositories\User\UserRepository;
use App\Modules\Core\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
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
