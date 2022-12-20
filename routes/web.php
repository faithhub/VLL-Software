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

// Route::get('home', function () {
//     return view('home');
// });
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
    Route::any('callback2',  [App\Http\Controllers\Auth\GoogleController::class,  'callbackFromGoogle2'])->name('callback2');
});

//User
Route::prefix('user')->name('user.')->group(function () {
    Route::group(['middleware' => ['user', 'auth']], function () { 
        Route::get('/',  [App\Http\Controllers\Dashboard\UserController::class, 'index'])->name('index');
        Route::get('library',  [App\Http\Controllers\Dashboard\UserController::class, 'library'])->name('library');
        Route::get('transactions',  [App\Http\Controllers\Dashboard\UserController::class, 'transactions'])->name('transactions');
        Route::get('view/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'view_material'])->name('view');
        Route::get('summary/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'summary_material'])->name('summary');
        Route::get('help',  [App\Http\Controllers\Dashboard\UserController::class, 'help'])->name('help');
        Route::get('settings',  [App\Http\Controllers\Dashboard\UserController::class, 'settings'])->name('settings');
    });
});

//Vendor
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::group(['middleware' => ['vendor', 'auth']], function () {
        Route::get('/',  [App\Http\Controllers\Dashboard\VendorController::class, 'index'])->name('index');
        Route::get('library',  [App\Http\Controllers\Dashboard\VendorController::class, 'library'])->name('library');
        Route::get('settings',  [App\Http\Controllers\Dashboard\VendorController::class, 'settings'])->name('settings');
        Route::get('help',  [App\Http\Controllers\Dashboard\VendorController::class, 'help'])->name('help');
        Route::get('transactions',  [App\Http\Controllers\Dashboard\VendorController::class, 'transactions'])->name('transactions');
        Route::get('summary/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'summary'])->name('summary');
        Route::get('upload',  [App\Http\Controllers\Dashboard\VendorController::class, 'upload'])->name('upload');
    });
});

//Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::group(['middleware' => ['admin', 'auth']], function () {
        Route::get('/',  [App\Http\Controllers\Dashboard\AdminController::class, 'index'])->name('index');
        Route::get('/users',  [App\Http\Controllers\Dashboard\AdminController::class, 'users'])->name('users');
        Route::get('/vendors',  [App\Http\Controllers\Dashboard\AdminController::class, 'vendors'])->name('vendors');
        Route::get('/library',  [App\Http\Controllers\Dashboard\AdminController::class, 'library'])->name('library');
        Route::match(['get', 'post'], '/upload',  [App\Http\Controllers\Dashboard\AdminController::class, 'upload'])->name('upload');
        Route::get('/transactions',  [App\Http\Controllers\Dashboard\AdminController::class, 'transactions'])->name('transactions');
    });
});