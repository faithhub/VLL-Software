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
Route::get('about-us', [App\Http\Controllers\Web\HomeController::class, 'about_us'])->name('about_us');
Route::get('faq', [App\Http\Controllers\Web\HomeController::class, 'faq'])->name('faq');
Route::match(['get', 'post'], 'contact-us', [App\Http\Controllers\Web\HomeController::class, 'contact'])->name('contact');

Route::prefix('google')->name('google.')->group(function () {
    Route::get('login',  [App\Http\Controllers\Auth\GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback',  [App\Http\Controllers\Auth\GoogleController::class,  'callbackFromGoogle'])->name('callback');
    Route::any('callback2',  [App\Http\Controllers\Auth\GoogleController::class,  'callbackFromGoogle2'])->name('callback2');
});

Route::group(['middleware' => ['auth']], function () {
    Route::match(['post'], 'change-currency',  [App\Http\Controllers\Admin\DashboardController::class, 'change_currency'])->name('change_currency');
});

//User
Route::prefix('user')->name('user.')->group(function () {
    Route::group(['middleware' => ['user', 'auth', 'check_sub']], function () {
        Route::get('/',  [App\Http\Controllers\Dashboard\UserController::class, 'index'])->name('index')->middleware('check_rented_materials');
        Route::get('library',  [App\Http\Controllers\Dashboard\UserController::class, 'library'])->name('library')->middleware('check_rented_materials');
        Route::get('transactions',  [App\Http\Controllers\Dashboard\UserController::class, 'transactions'])->name('transactions');
        Route::get('view/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'view_material'])->name('view')->middleware('check_rented_materials');
        Route::get('summary/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'summary_material'])->name('summary');
        Route::get('view-folder/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'view_folder'])->name('view_folder');
        Route::match(['get', 'post'], 'help',  [App\Http\Controllers\Dashboard\UserController::class, 'help'])->name('help');
        Route::match(['get', 'post'], 'settings',  [App\Http\Controllers\Dashboard\UserController::class, 'settings'])->name('settings');
        Route::get('subscriptions',  [App\Http\Controllers\Dashboard\UserController::class, 'subscriptions'])->name('subscriptions');
        Route::get('sub_text/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'sub_text'])->name('sub.text');
        Route::match(['get'], 'view_material/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'view_material'])->name('view_material');
        Route::match(['get'], 'view_material_type/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'view_material_type'])->name('view_material_type');
        Route::match(['post'], 'subscribe',  [App\Http\Controllers\Dashboard\UserController::class, 'subscribe'])->name('subscribe');
        Route::match(['post'], 'buy_rent_material',  [App\Http\Controllers\Dashboard\UserController::class, 'buy_rent_material'])->name('rent.buy')->middleware('sub');
        Route::match(['get'], 'add_to_library/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'add_to_library'])->name('add_to_library')->middleware('sub');
        Route::match(['get'], 'second_rent/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'second_rent'])->name('second_rent')->middleware('sub');
        Route::match(['get', 'post'], 'access-material/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'access_material'])->name('access_material');
        Route::match(['get', 'post'], 'send-note/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'send_note'])->name('send_note');
        Route::match(['get', 'post'], 'invite_teammate',  [App\Http\Controllers\Dashboard\UserController::class, 'invite_teammate'])->name('invite_teammate');
        Route::match(['get', 'post'], 'accept/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'accept_invite'])->name('accept_invite');
        Route::match(['get', 'post'], 'remove/{id}/{email}',  [App\Http\Controllers\Dashboard\UserController::class, 'remove_teammate'])->name('remove_teammate');
        Route::match(['get', 'post'], 'decline/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'decline_invite'])->name('decline_invite');
        Route::match(['get', 'post'], 'set-current-note',  [App\Http\Controllers\Dashboard\UserController::class, 'set_current_note'])->name('set.current.note');
    });
});

//Vendor
Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::group(['middleware' => ['vendor', 'auth']], function () {
        Route::match(['get'], '/',  [App\Http\Controllers\Dashboard\VendorController::class, 'index'])->name('index');
        // Route::get('library',  [App\Http\Controllers\Dashboard\VendorController::class, 'library'])->name('library');
        Route::match(['get', 'post'], 'settings',  [App\Http\Controllers\Dashboard\VendorController::class, 'settings'])->name('settings');
        Route::match(['get', 'post'], 'help',  [App\Http\Controllers\Dashboard\VendorController::class, 'help'])->name('help');
        Route::get('transactions',  [App\Http\Controllers\Dashboard\VendorController::class, 'transactions'])->name('transactions');
        Route::get('summary/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'summary'])->name('summary');
        Route::get('subscriptions',  [App\Http\Controllers\Dashboard\VendorController::class, 'subscriptions'])->name('subscriptions');
        Route::match(['post'], 'subscribe',  [App\Http\Controllers\Dashboard\VendorController::class, 'subscribe'])->name('subscribe');
        Route::match(['get', 'post'], 'verifyBank',  [App\Http\Controllers\Dashboard\VendorController::class, 'verifyBank'])->name('verifyBank');
        Route::match(['get'], 'view_material/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'view_material'])->name('view_material');
        Route::get('view-folder/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'view_folder'])->name('view_folder');
        Route::match(['get', 'post'], 'upload',  [App\Http\Controllers\Dashboard\VendorController::class, 'upload'])->name('upload');
        Route::match(['get', 'post'], 'edit/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'edit'])->name('edit');
        Route::match(['get'], 'delete/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'delete'])->name('delete');
        Route::match(['get', 'post'], 'add_folder',  [App\Http\Controllers\Dashboard\VendorController::class, 'add_folder'])->name('add_folder');
    });
});

//Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::group(['middleware' => ['admin', 'auth']], function () {
        Route::get('/',  [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

        //Users
        Route::get('/users',  [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');

        //Vendors
        Route::get('/vendors',  [App\Http\Controllers\Admin\VendorController::class, 'index'])->name('vendors');
        Route::get('/vendor/{id}',  [App\Http\Controllers\Admin\VendorController::class, 'view'])->name('vendor');

        Route::get('/library',  [App\Http\Controllers\Admin\MaterialController::class, 'library'])->name('library');
        Route::match(['get', 'post'], '/upload',  [App\Http\Controllers\Admin\MaterialController::class, 'upload'])->name('upload');
        Route::match(['get', 'post'], '/edit/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'edit'])->name('edit.library');
        Route::match(['get'], '/library/view/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view'])->name('view.library');


        Route::get('/transactions',  [App\Http\Controllers\Admin\DashboardController::class, 'transactions'])->name('transactions');
        Route::match(['get', 'post'], '/settings',  [App\Http\Controllers\Admin\DashboardController::class, 'settings'])->name('settings');
        Route::match(['get', 'post'], '/profile',  [App\Http\Controllers\Admin\DashboardController::class, 'profile'])->name('profile');
        
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

        //Folder
        Route::match(['get', 'post'], 'add_folder',  [App\Http\Controllers\Admin\MaterialController::class, 'add_folder'])->name('add_folder');


        //FAQ
        Route::match(['get', 'post'], '/add_faq',  [App\Http\Controllers\Admin\FAQController::class, 'add_faq'])->name('add_faq');
        Route::match(['get'], '/view_faq/{id}',  [App\Http\Controllers\Admin\FAQController::class, 'view_faq'])->name('view_faq');
        Route::get('/delete_faq/{id}',  [App\Http\Controllers\Admin\FAQController::class, 'delete_faq'])->name('delete_faq');
        
        //Subscription
        Route::match(['get', 'post'], '/edit_subscription/{id}',  [App\Http\Controllers\Admin\SubscriptionController::class, 'edit_subscription'])->name('edit_subscription');
        Route::match(['get'], '/view_subscription/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_subscription'])->name('view_subscription');
        Route::get('/delete_subscription/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete_subscription'])->name('delete_subscription');
        // Route::get('/update_subject_status/{id}/{value}',  [App\Http\Controllers\Admin\SubscriptionController::class, 'update_subject_status'])->name('update_subject_status');

        //Messages
        Route::match(['get', 'post'], '/messages',  [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages');
    });
});