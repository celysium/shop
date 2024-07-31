<?php

namespace App\Modules\Core\Providers;

use App\Modules\Core\Models\Cart;
use App\Modules\Core\Observers\CartObserver;
use App\Modules\Core\Repositories\Address\AddressRepository;
use App\Modules\Core\Repositories\Address\AddressRepositoryInterface;
use App\Modules\Core\Repositories\Banner\BannerRepository;
use App\Modules\Core\Repositories\Banner\BannerRepositoryInterface;
use App\Modules\Core\Repositories\Cart\CartRepository;
use App\Modules\Core\Repositories\Cart\CartRepositoryInterface;
use App\Modules\Core\Repositories\Category\CategoryRepository;
use App\Modules\Core\Repositories\Category\CategoryRepositoryInterface;
use App\Modules\Core\Repositories\Constant\ConstantRepository;
use App\Modules\Core\Repositories\Constant\ConstantRepositoryInterface;
use App\Modules\Core\Repositories\Delivery\DeliveryRepository;
use App\Modules\Core\Repositories\Delivery\DeliveryRepositoryInterface;
use App\Modules\Core\Repositories\Inventory\InventoryRepository;
use App\Modules\Core\Repositories\Inventory\InventoryRepositoryInterface;
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
        $this->registerObserver();
    }

    public function registerRepositories(): void
    {
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ConstantRepositoryInterface::class, ConstantRepository::class);
        $this->app->bind(DeliveryRepositoryInterface::class, DeliveryRepository::class);
        $this->app->bind(InventoryRepositoryInterface::class, InventoryRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OTPRepositoryInterface::class, OTPRepository::class);
    }

    public function registerObserver()
    {
        Cart::observe(CartObserver::class);
    }
}
