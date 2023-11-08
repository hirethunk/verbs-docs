<?php

use App\Data\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// Custom Pages / Routes
// ------------------------------------------------------------------------------------------

Route::get('/', function () {
    return view('welcome');
});

// Open Graph
// ------------------------------------------------------------------------------------------

Route::get('/__og-src/{section}/{item}', function(string $section, string $item) {
	$section = app(Navigation::class)->section($section);
	
	return view('og-src', ['page' => $section->item($item)->page()]);
});

// Docs
// ------------------------------------------------------------------------------------------

Route::get('/docs', function() {
	try {
		$section = app(Navigation::class)->sections->first();
		$item = $section->items->first();
		return to_route('docs.section.item', [$section->slug, $item->slug]);
	} catch (Throwable) {
		abort(404);
	}
});

Route::get('/docs/{section}', function(string $section) {
	try {
		$section = app(Navigation::class)->section($section);
		$item = $section->items->first();
		return to_route('docs.section.item', [$section->slug, $item->slug]);
	} catch (Throwable) {
		abort(404);
	}
});

Route::get('/docs/{section}/{item}', function(string $section, string $item) {
	try {
		$section = app(Navigation::class)->section($section);
		$item = $section->item($item);
		
		View::share('active_item', $item);
		
		return view('docs.page', [
			'section' => $section,
			'item' => $item,
			'page' => $item->page()
		]);
	} catch (Throwable) {
		abort(404);
	}
})->name('docs.section.item');

// Examples
// ------------------------------------------------------------------------------------------

Route::redirect('/examples', '/docs');

Route::get('/examples/{example}', function(string $example) {
	try {
		$navigation = Navigation::example($example);
		$section = $navigation->sections->first();
		$item = $section->items->first();
		return to_route('examples.section.item', [$example, $section->slug, $item->slug]);
	} catch (Throwable) {
		abort(404);
	}
});

Route::get('/examples/{example}/{section}', function(string $example, string $section) {
	try {
		$navigation = Navigation::example($example);
		$section = $navigation->section($section);
		$item = $section->items->first();
		return to_route('examples.section.item', [$example, $section->slug, $item->slug]);
	} catch (Throwable) {
		abort(404);
	}
});

Route::get('/examples/{example}/{section}/{item}', function(string $example, string $section, string $item) {
	try {
		$navigation = Navigation::example($example);
		$section = $navigation->section($section);
		$item = $section->item($item);
		
		dd($item);
		
		// View::share('example_navigation', $navigation);
		
		return view('examples.file', [
			'section' => $section->title,
			'title' => $item->title,
			'source' => File::get($path),
		]);
		
	} catch (Throwable) {
		abort(404);
	}
	
})->name('examples.section.item');
