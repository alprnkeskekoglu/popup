<?php

namespace Dawnstar\Popup;

use Dawnstar\Popup\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class PopupServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/Resources/views/panel', 'Popup');
        $this->loadViewsFrom(__DIR__ . '/Resources/views/web', 'PopupWeb');
        $this->loadTranslationsFrom(__DIR__ . '/Resources/lang', 'Popup');

        $this->publishes([__DIR__ . '/Assets' => public_path('vendor/dawnstar/popup')], 'dawnstar-popup-assets');
    }
}
