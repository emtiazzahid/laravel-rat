<?php

namespace Emtiazzahid\LaravelRat;

use Emtiazzahid\LaravelRat\Console\RunRatCommand;
use Illuminate\Support\ServiceProvider;

class LaravelRatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-rat');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-rat');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-rat.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-rat'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-rat'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-rat'),
            ], 'lang');*/

            // Registering package commands.
             $this->commands([
                 RunRatCommand::class
             ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-rat');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-rat', function () {
            return new LaravelRat();
        });

    }
}
