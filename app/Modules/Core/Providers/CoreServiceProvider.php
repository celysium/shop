<?php

namespace App\Modules\Core\Providers;

use App\Modules\Core\Models\Cart;
use App\Modules\Core\Models\Category;
use App\Modules\Core\Observers\CartObserver;
use App\Modules\Core\Observers\CategoryObserver;
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
use App\Modules\Core\Repositories\File\FileRepository;
use App\Modules\Core\Repositories\File\FileRepositoryInterface;
use App\Modules\Core\Repositories\Inventory\InventoryRepository;
use App\Modules\Core\Repositories\Inventory\InventoryRepositoryInterface;
use App\Modules\Core\Repositories\Location\LocationRepository;
use App\Modules\Core\Repositories\Location\LocationRepositoryInterface;
use App\Modules\Core\Repositories\Order\OrderRepository;
use App\Modules\Core\Repositories\Order\OrderRepositoryInterface;
use App\Modules\Core\Repositories\OrderItem\OrderItemRepository;
use App\Modules\Core\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Modules\Core\Repositories\PasswordToken\PasswordTokenRepository;
use App\Modules\Core\Repositories\PasswordToken\PasswordTokenRepositoryInterface;
use App\Modules\Core\Repositories\Payment\PaymentRepository;
use App\Modules\Core\Repositories\Payment\PaymentRepositoryInterface;
use App\Modules\Core\Repositories\Product\ProductRepository;
use App\Modules\Core\Repositories\Product\ProductRepositoryInterface;
use App\Modules\Core\Repositories\ProductImage\ProductImageRepository;
use App\Modules\Core\Repositories\ProductImage\ProductImageRepositoryInterface;
use App\Modules\Core\Repositories\ProductIndex\ProductIndexRepository;
use App\Modules\Core\Repositories\ProductIndex\ProductIndexRepositoryInterface;
use App\Modules\Core\Repositories\ProductWidget\ProductWidgetRepository;
use App\Modules\Core\Repositories\ProductWidget\ProductWidgetRepositoryInterface;
use App\Modules\Core\Repositories\Slider\SliderRepository;
use App\Modules\Core\Repositories\Slider\SliderRepositoryInterface;
use App\Modules\Core\Repositories\Store\StoreRepository;
use App\Modules\Core\Repositories\Store\StoreRepositoryInterface;
use App\Modules\Core\Repositories\User\UserRepository;
use App\Modules\Core\Repositories\User\UserRepositoryInterface;
use App\Modules\Core\Repositories\Widget\WidgetRepository;
use App\Modules\Core\Repositories\Widget\WidgetRepositoryInterface;
use DirectoryIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerObserver();
        $this->registerFacades();
        $this->loadMigrations();
        $this->registerConfig();
        $this->publishConfig();
    }


    public function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrates');
    }

    public function registerRepositories(): void
    {
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ConstantRepositoryInterface::class, ConstantRepository::class);
        $this->app->bind(DeliveryRepositoryInterface::class, DeliveryRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
        $this->app->bind(InventoryRepositoryInterface::class, InventoryRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(PasswordTokenRepositoryInterface::class, PasswordTokenRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductImageRepositoryInterface::class, ProductImageRepository::class);
        $this->app->bind(ProductIndexRepositoryInterface::class, ProductIndexRepository::class);
        $this->app->bind(ProductWidgetRepositoryInterface::class, ProductWidgetRepository::class);
        $this->app->bind(SliderRepositoryInterface::class, SliderRepository::class);
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(WidgetRepositoryInterface::class, WidgetRepository::class);
    }

    public function registerObserver(): void
    {
        Cart::observe(CartObserver::class);
        Category::observe(CategoryObserver::class);
    }

    private function registerFacades(): void
    {
        $this->app->bind('store-repository', fn() => new StoreRepository());
        $this->app->bind('inventory-repository', fn() => new InventoryRepository());
    }

    public function registerConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/core.php', 'core'
        );

    }

    public function publishConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../Config/core.php' => config_path('core.php'),
        ], 'core-config');
    }
}
