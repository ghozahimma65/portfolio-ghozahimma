<?php

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\SettingsComposer;

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
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }

    View::composer([
        'layouts.app',
        'pages.*',
        'sections.*',
    ], SettingsComposer::class);
}
}
