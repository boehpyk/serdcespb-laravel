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
    
    /*
     * Caroousel slides
     */
    Route::get('/carousel', 'CarouselController@index')->name('admin_carousel_index')->defaults('archive', false);
    Route::get('/carousel/create', 'CarouselController@create')->name('admin_carousel_create');
    Route::post('/carousel/create', 'CarouselController@store')->name('admin_carousel_store');
    Route::get('/carousel/{slide}', 'CarouselController@show')->where('id', '[0-9]+')->name('admin_carousel_show');
    Route::get('/carousel/{slide}/edit', 'CarouselController@edit')->where('id', '[0-9]+')->name('admin_carousel_edit');
    Route::post('/carousel/{slide}/edit', 'CarouselController@update')->where('id', '[0-9]+')->name('admin_carousel_update');
    Route::post('/carousel/{slide}/delete', 'CarouselController@destroy')->where('id', '[0-9]+')->name('admin_carousel_delete');

    /*
     * Texts
     */
    Route::get('/texts', 'TextController@index')->name('admin_texts_index')->defaults('archive', false);
    Route::get('/texts/create', 'TextController@create')->name('admin_texts_create');
    Route::post('/texts/create', 'TextController@store')->name('admin_texts_store');
    Route::get('/texts/{slug}/edit', 'TextController@edit')->where('id', '[0-9]+')->name('admin_texts_edit');
    Route::post('/texts/{slug}/edit', 'TextController@update')->where('id', '[0-9]+')->name('admin_texts_update');
    Route::post('/texts/{slug}/delete', 'TextController@destroy')->where('id', '[0-9]+')->name('admin_texts_delete');

    /*
     * News
     */
    Route::get('/news', 'NewsController@index')->name('admin.news.index')->defaults('archive', false);
    Route::get('/news/archive', 'NewsController@index')->name('admin.news.archive')->defaults('archive', true);
    Route::get('/news/create', 'NewsController@create')->name('admin.news.create');
    Route::post('/news/create', 'NewsController@store')->name('admin.news.store');
    Route::get('/news/{news}', 'NewsController@show')->where('id', '[0-9]+')->name('admin.news.show');
    Route::get('/news/{news}/edit', 'NewsController@edit')->where('id', '[0-9]+')->name('admin.news.edit');
    Route::post('/news/{news}/edit', 'NewsController@update')->where('id', '[0-9]+')->name('admin.news.update');
    Route::post('/news/{news}/delete', 'NewsController@destroy')->where('id', '[0-9]+')->name('admin.news.delete');

    /*
     * CKEditor for file uploading
     */
    Route::get('/ckeditor', 'CkeditorController@index');
    Route::post('/ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

});

Route::get('/', 'HomeController@home')->name('index.page');
Route::get('/afisha', 'EventController@index')->name('events.index');
Route::get('/news', 'NewsController@index')->name('news.index');
Route::get('/gallery', 'GalleryController@index')->name('gallery.index');

Auth::routes();

Route::get('/{slug}', 'TextController@show')->name('text.show');




