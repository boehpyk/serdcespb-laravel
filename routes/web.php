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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'App\Http\Middleware\AdminMiddleware']], function() {
    Route::get('/', function () {
        return view('admin/index');
    })->name('admin_index');
    Route::get('/events', 'EventController@index')->name('admin_events_index')->defaults('archive', false);
    Route::get('/events/archive', 'EventController@index')->name('admin_events_archive')->defaults('archive', true);
    Route::get('/events/create', 'EventController@create')->name('admin_events_create');
    Route::post('/events/create', 'EventController@store')->name('admin_events_store');
    Route::get('/events/{event}', 'EventController@show')->where('id', '[0-9]+')->name('admin_events_show');
    Route::get('/events/{event}/edit', 'EventController@edit')->where('id', '[0-9]+')->name('admin_events_edit');
    Route::post('/events/{event}/edit', 'EventController@update')->where('id', '[0-9]+')->name('admin_events_update');
    Route::post('/events/{event}/delete', 'EventController@destroy')->where('id', '[0-9]+')->name('admin_events_delete');
});

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
