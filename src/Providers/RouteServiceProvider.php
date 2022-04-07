<?php

namespace Dawnstar\Popup\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::middleware(['web', 'dawnstar_auth'])
                ->prefix('dawnstar')
                ->as('dawnstar.')
                ->group(__DIR__.'/../Routes/panel.php');
        });
    }
}
