<?php

namespace App\Providers;

use App\Data\Navigation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->singleton(Navigation::class);
	}
	
	public function boot(): void
	{
		View::share('active_item', null);
		View::share('navigation', app(Navigation::class));
	}
}
