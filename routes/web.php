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

Route::get('/docs/{section}/{item}', function(string $section, string $item) {
	$section = app(Navigation::class)->section($section);
	$item = $section->item($item);
	
	View::share('active_item', $item);
	
	return view('docs.page', [
		'page' => $item->page()
	]);
})->name('docs.section.item');
