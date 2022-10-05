<?php

namespace App\Providers;

use App\Models\Admin\Menu;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer("theme.adminlte.aside", function ($view)
        // {
        //     $menus = Menu::getMenu(true);
        //     $view->with("menusComposer", $menus);
        // });
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        View::share('theme', 'adminlte');
    }
}
