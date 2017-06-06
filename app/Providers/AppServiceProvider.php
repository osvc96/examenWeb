<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MovimientoInventario;
use App\Observers\MovimientoInventarioObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        MovimientoInventario::observe(MovimientoInventarioObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
