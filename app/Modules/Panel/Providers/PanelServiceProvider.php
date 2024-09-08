<?php

namespace App\Modules\Panel\Providers;

use App\Modules\Panel\Services\Authentication\AuthenticationService;
use App\Modules\Panel\Services\Authentication\AuthenticationServiceInterface;
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
