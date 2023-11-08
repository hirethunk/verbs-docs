<?php

namespace App\Providers;

use App\Data\Navigation;
use Illuminate\Foundation\Application;
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
		View::share('active_item', null);
		View::share('navigation', app(Navigation::class));
	}
}
