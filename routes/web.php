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
        Route::match(['get', 'post'], 'settings',  [App\Http\Controllers\Dashboard\UserController::class, 'settings'])->name('settings');
        Route::get('subscriptions',  [App\Http\Controllers\Dashboard\UserController::class, 'subscriptions'])->name('subscriptions');
        Route::match(['get'], 'view_material/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'view_material'])->name('view_material');
    });
});

//Vendor
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::group(['middleware' => ['vendor', 'auth']], function () {
        Route::get('/',  [App\Http\Controllers\Dashboard\VendorController::class, 'index'])->name('index');
        Route::get('library',  [App\Http\Controllers\Dashboard\VendorController::class, 'library'])->name('library');
        Route::match(['get', 'post'], 'settings',  [App\Http\Controllers\Dashboard\VendorController::class, 'settings'])->name('settings');
        Route::get('help',  [App\Http\Controllers\Dashboard\VendorController::class, 'help'])->name('help');
        Route::get('transactions',  [App\Http\Controllers\Dashboard\VendorController::class, 'transactions'])->name('transactions');
        Route::get('summary/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'summary'])->name('summary');
        Route::match(['get', 'post'], 'upload',  [App\Http\Controllers\Dashboard\VendorController::class, 'upload'])->name('upload');
        Route::get('subscriptions',  [App\Http\Controllers\Dashboard\VendorController::class, 'subscriptions'])->name('subscriptions');
        Route::match(['get', 'post'], 'add_folder',  [App\Http\Controllers\Dashboard\VendorController::class, 'add_folder'])->name('add_folder');
        Route::match(['get', 'post'], 'verifyBank',  [App\Http\Controllers\Dashboard\VendorController::class, 'verifyBank'])->name('verifyBank');
        Route::match(['get'], 'view_material/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'view_material'])->name('view_material');
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
        Route::get('/messages',  [App\Http\Controllers\Dashboard\AdminController::class, 'messages'])->name('messages');
        Route::match(['get', 'post'], '/settings',  [App\Http\Controllers\Dashboard\AdminController::class, 'settings'])->name('settings');

        // Material Type
        Route::match(['get', 'post'], '/add_material',  [App\Http\Controllers\Admin\MaterialController::class, 'add_material'])->name('add_material');
        Route::match(['get'], '/view_material/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_material'])->name('view_material');
        Route::get('/delete_material/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete_material'])->name('delete_material');
        // Route::get('/update_material_status/{id}/{value}',  [App\Http\Controllers\Dashboard\AdminController::class, 'update_material_status'])->name('update_material_status');

        Route::get('/test',  [App\Http\Controllers\Dashboard\AdminController::class, 'test'])->name('test');
        // Subject Type
        Route::match(['get', 'post'], '/add_subject',  [App\Http\Controllers\Admin\MaterialController::class, 'add_subject'])->name('add_subject');
        Route::match(['get'], '/view_subject/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_subject'])->name('view_subject');
        Route::get('/delete_subject/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete_subject'])->name('delete_subject');

        //Subscription
        Route::match(['get', 'post'], '/edit_subscription/{id}',  [App\Http\Controllers\Admin\SubscriptionController::class, 'edit_subscription'])->name('edit_subscription');
        Route::match(['get'], '/view_subscription/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_subscription'])->name('view_subscription');
        Route::get('/delete_subscription/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete_subscription'])->name('delete_subscription');
        // Route::get('/update_subject_status/{id}/{value}',  [App\Http\Controllers\Admin\SubscriptionController::class, 'update_subject_status'])->name('update_subject_status');
    });
});