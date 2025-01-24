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
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'arimolzer');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'arimolzer');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/arimolzer'),
        ], 'ipstack.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/arimolzer'),
        ], 'ipstack.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/arimolzer'),
        ], 'ipstack.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
