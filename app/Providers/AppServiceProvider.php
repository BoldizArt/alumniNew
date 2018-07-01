<?php

namespace Alumni\Providers;

use Illuminate\Support\ServiceProvider;
use Alumni\Http\Controllers\Profile\AdminController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(AdminController $admin)
    {
        // Share new profiles count with views.
        $count = $admin->newUsers();
        \View::share('newProfiles', $count);
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
