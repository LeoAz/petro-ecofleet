<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

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
        Flash::levels([
            'success' => 'alert-success bg-teal-dim',
            'warning' => 'alert-warning bg-warning-dim',
            'error' => 'alert-danger bg-danger-dim',
            'info' => 'alert-primary bg-blue-dim ',
        ]);

        Carbon::setLocale(config('app.locale'));
    }
}
