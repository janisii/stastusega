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

// Admin site with auth protection
Auth::routes();

// Image output path
Route::get('/i/{path}', function ($path) {
    $server = \League\Glide\ServerFactory::create([
        'source' => storage_path('app/images'),
        'cache' => storage_path('app/images/cache'),
    ]);
    echo $server->outputImage($path, $_GET);
});

Route::group(['middleware' => 'auth'], function () {

    // app home
    Route::get('/home', 'HomeController@index')->name('home');

    // fragments crud
    Route::get('/fragments', 'FragmentController@index')->name('fragments');
    Route::get('/fragments/create', 'FragmentController@create')->name('fragments-create');
    Route::post('/fragments', 'FragmentController@store')->name('fragments-store');
    Route::get('/fragments/{fragment}/show', 'FragmentController@show')->name('fragments-show');
    Route::get('/fragments/{fragment}/edit', 'FragmentController@edit')->name('fragments-edit');
    Route::put('/fragments/{fragment}', 'FragmentController@update')->name('fragments-update');
    Route::delete('/fragments/{fragment}', 'FragmentController@delete')->name('fragments-delete');
    Route::get('/fragment/image/remove/{image}', 'FragmentController@fragmentImageRemove')->name('fragment-image-remove');
    Route::get('/fragment/image/attach/{fragment}/{image}', 'FragmentController@fragmentImageAttach')->name('fragment-image-attach');

    // frames
    Route::get('/frames/manager/{frame}', 'FrameController@manager')->name('frame-manager');
    Route::get('/frame/image/attach', 'FrameController@attachImageFrame')->name('frame-image-attach');
    Route::get('/frame/image/remove', 'FrameController@removeImageFrame')->name('frame-image-remove');

    // sync fragments with stories
    Route::get('/sync', 'ImageController@sync')->name('sync');
    Route::post('/sync/fragment', 'ImageController@syncImageFragment')->name('sync-image-fragment');

});

// Admin ONLY routes
Route::group(['middleware' => 'auth.admin'], function () {
    Route::get('/f/images', 'ImageController@index')->name('images');
    Route::get('/f/images/apply', 'ImageController@apply')->name('images-apply');
    Route::post('/f/images/upload', 'ImageController@upload')->name('images-upload');
    Route::get('/f/images/generate', 'ImageController@generateFragments')->name('generate-stories');
});

/**
 * Fall back from dev
 */
Route::get('/public', function () {
    return redirect()->route('react');
});

/**
 * Public site
 */
Route::get('/{path?}', function () {

//    if (Auth::user() === null && strtotime('2018-11-06 08:00:00') > time()) {
//        return view('welcome');
//    }

    return view('public.app');

})->where('path', '.*')->name('react');