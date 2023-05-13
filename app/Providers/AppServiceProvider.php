<?php

namespace App\Providers;

use App\View\Components\Table;
use App\View\Components\Back;
use App\View\Components\CheckboxAccess;
use App\View\Components\CheckboxPermissions;
use App\View\Components\CheckboxRoles;
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
        Blade::component('checkbox-permissions', CheckboxPermissions::class);
        Blade::component('checkbox-access', CheckboxAccess::class);
    }
}
