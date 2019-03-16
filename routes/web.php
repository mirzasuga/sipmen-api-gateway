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
use Illuminate\Support\Facades\Redis;
use App\Events\VendorRegistered;

Route::get('/', function () {
    // Redis::publish('App.User.1', json_encode(['cache' => 'clear']));

    return view('welcome');
})->middleware(['cors']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function() {
    return response()->json(['data' => 'ok']);
});
