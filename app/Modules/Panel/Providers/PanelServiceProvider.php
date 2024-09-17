<?php

namespace App\Modules\Panel\Providers;

use App\Modules\Panel\Services\Authentication\AuthenticationService;
use App\Modules\Panel\Services\Authentication\AuthenticationServiceInterface;
use App\Modules\Panel\Services\Banner\BannerService;
use App\Modules\Panel\Services\Banner\BannerServiceInterface;
use App\Modules\Panel\Services\Category\CategoryService;
use App\Modules\Panel\Services\Category\CategoryServiceInterface;
use App\Modules\Panel\Services\Inventory\InventoryService;
use App\Modules\Panel\Services\Inventory\InventoryServiceInterface;
use App\Modules\Panel\Services\Widget\WidgetService;
use App\Modules\Panel\Services\Widget\WidgetServiceInterface;
use Illuminate\Support\ServiceProvider;

class PanelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerServices();
        $this->registerConfig();
        $this->publishConfig();
    }

    private function registerServices(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->bind(BannerServiceInterface::class, BannerService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(InventoryServiceInterface::class, InventoryService::class);
        $this->app->bind(WidgetServiceInterface::class, WidgetService::class);
    }

    public function registerConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/panel.php', 'panel'
        );

    }

    public function publishConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../Config/panel.php' => config_path('panel.php'),
        ], 'panel-config');
    }
}
