<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        // Share global settings (SEO, contact, profile) with all public-facing views.
        // This replaces direct Setting::get() calls inside Blade templates (MVC violation).
        // The composer consolidates all DB reads into a single call per request.
        View::composer([
            'layouts.app',
            'pages.*',
            'sections.*',
        ], SettingsComposer::class);
    }
}
