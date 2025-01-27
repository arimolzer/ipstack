<?php

namespace Arimolzer\IPStack;

use Illuminate\Support\ServiceProvider;

class IPStackServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ipstack.php', 'ipstack');

        // Register the service the package provides.
        $this->app->singleton('ipstack', function ($app) {
            return new IPStack;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ipstack'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/ipstack.php' => config_path('ipstack.php'),
        ], 'ipstack.config');
    }
}
