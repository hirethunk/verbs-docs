<?php

use App\Data\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/__og-src/{section}/{item}', function(string $section, string $item) {
	$section = app(Navigation::class)->section($section);
	
	return view('og-src', ['page' => $section->item($item)->page()]);
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

Route::get('/examples/{example}/{file}', function(string $example, string $file) {
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
})->name('examples.section.item');
