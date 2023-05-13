<?php

namespace App\Providers;

use App\View\Components\Table;
use App\View\Components\Back;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(125);

        Blade::component('table', Table::class);
        Blade::component('back', Back::class);
    }
}
