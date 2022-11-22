<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/test', function () {
//     return view('test');
// });

Auth::routes();

Route::match(['get', 'post'], '/register/vendor', [App\Http\Controllers\Auth\RegisterController::class, 'vendor'])->name('vendor_reg');

Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
Route::get('privacy', [App\Http\Controllers\Web\HomeController::class, 'privacy'])->name('privacy');

Route::prefix('google')->name('google.')->group(function () {
    Route::get('login',  [App\Http\Controllers\Auth\GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback',  [App\Http\Controllers\Auth\GoogleController::class,  'callbackFromGoogle'])->name('callback');
});