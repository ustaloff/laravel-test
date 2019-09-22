<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Page;

Route::match(['get', 'post'], '/', 'PageController@index')->name('page.index');

Route::get('/{link}', function ($link) {
	return view('page', [
		'link' => Page::where('short_link', '=', $link)->firstOrFail()
	]);
});
