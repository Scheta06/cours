<?php

namespace App\Providers;

use App\Services\PcCompatibilityChecker;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PcCompatibilityChecker::class, function ($app) {
            return new PcCompatibilityChecker();
        });

        $this->app->singleton(ConfigurationService::class, function ($app) {
            return new ConfigurationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
