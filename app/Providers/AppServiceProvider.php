<?php

namespace App\Providers;

use App\Data\Navigation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Navigation::class, function() {
            return new Navigation(
                path: 'docs/main/docs/navigation.json',
                prefix: 'docs',
            );
        });
    }

    public function boot(): void
    {
        $this->callAfterResolving('view', function() {
            View::share('active_item', null);
            View::share('navigation', app(Navigation::class));
        });
        
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
