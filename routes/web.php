<?php

use App\Http\Controllers\ZoomController;
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

Route::get('start', [ZoomController::class, 'index']);
Route::any('zoom-meeting-create', [ZoomController::class, 'index']);


Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
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
    //Change currency
    Route::get('/join-meeting/{token}',  [App\Http\Controllers\Web\HomeController::class, 'zoom'])->name('join.meeting');

    
    Route::match(['post'], 'change-currency',  [App\Http\Controllers\Admin\DashboardController::class, 'change_currency'])->name('change_currency');
    //Payment Confrimation
    Route::get('/confirm-transaction',  [App\Http\Controllers\FlutterwaveController::class, 'confirm'])->name('confirm.payment');
    Route::get('/material-confirm-transaction',  [App\Http\Controllers\FlutterwaveController::class, 'confirm_material'])->name('material.payment');
    Route::post('/save-transaction',  [App\Http\Controllers\FlutterwaveController::class, 'save_transaction'])->name('save.transaction');
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
        Route::match(['get'], 'add_free_folder_to_library/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'add_free_folder_to_library'])->name('add_free_folder_to_library')->middleware('sub');
        Route::match(['get'], 'second_rent/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'second_rent'])->name('second_rent')->middleware('sub');
        Route::match(['get', 'post'], 'access-material/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'access_material'])->name('access_material')->middleware('myHeader');
        Route::match(['get', 'post'], 'send-note/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'send_note'])->name('send_note');
        Route::match(['get', 'post'], 'delete-note',  [App\Http\Controllers\Dashboard\UserController::class, 'delete_note'])->name('delete_note');
        Route::match(['get', 'post'], 'invite_teammate',  [App\Http\Controllers\Dashboard\UserController::class, 'invite_teammate'])->name('invite_teammate');
        Route::match(['get', 'post'], 'accept/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'accept_invite'])->name('accept_invite');
        Route::match(['get', 'post'], 'remove/{id}/{email}',  [App\Http\Controllers\Dashboard\UserController::class, 'remove_teammate'])->name('remove_teammate');
        Route::match(['get', 'post'], 'decline/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'decline_invite'])->name('decline_invite');
        Route::match(['get', 'post'], 'set-current-note',  [App\Http\Controllers\Dashboard\UserController::class, 'set_current_note'])->name('set.current.note');
        Route::match(['get'], 'notes',  [App\Http\Controllers\Dashboard\UserController::class, 'notes'])->name('notes');
        Route::match(['get', 'post'], 'note/{id}',  [App\Http\Controllers\Dashboard\UserController::class, 'note'])->name('note');
        Route::match(['post'], 'unlock-test',  [App\Http\Controllers\Dashboard\UserController::class, 'unlock_test'])->name('unlock_test');
        Route::match(['get', 'post'], 'change-password',  [App\Http\Controllers\Dashboard\UserController::class, 'change_password'])->name('change-password');
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
        Route::get('payouts',  [App\Http\Controllers\Dashboard\VendorController::class, 'payouts'])->name('payouts');
        Route::get('summary/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'summary'])->name('summary');
        Route::get('subscriptions',  [App\Http\Controllers\Dashboard\VendorController::class, 'subscriptions'])->name('subscriptions');
        Route::match(['post'], 'subscribe',  [App\Http\Controllers\Dashboard\VendorController::class, 'subscribe'])->name('subscribe');
        Route::match(['get', 'post'], 'verifyBank',  [App\Http\Controllers\Dashboard\VendorController::class, 'verifyBank'])->name('verifyBank');
        Route::match(['get'], 'view_material/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'view_material'])->name('view_material');
        Route::get('view-folder/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'view_folder'])->name('view_folder');
        Route::match(['get', 'post'], 'upload',  [App\Http\Controllers\Dashboard\VendorController::class, 'upload'])->name('upload');
        Route::match(['get', 'post'], 'edit/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'edit'])->name('edit');
        Route::match(['get'], 'delete/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'delete'])->name('delete');

        Route::match(['get'], '/material/cancel',  [App\Http\Controllers\Dashboard\VendorController::class, 'cancel'])->name('cancel.library');

        Route::match(['get'], 'folders',  [App\Http\Controllers\Dashboard\VendorController::class, 'folders'])->name('folders');
        Route::match(['get', 'post'], 'add_folder',  [App\Http\Controllers\Dashboard\VendorController::class, 'add_folder'])->name('add_folder');
        Route::match(['get', 'post'], 'edit_folder/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'edit_folder'])->name('edit_folder');
        Route::match(['get'], 'delete_folder/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'delete_folder'])->name('delete_folder');
        // Route::match(['get'], 'view_folder/{id}',  [App\Http\Controllers\Dashboard\VendorController::class, 'view_folder'])->name('view_folder');

        Route::match(['get', 'post'], 'change-password',  [App\Http\Controllers\Dashboard\VendorController::class, 'change_password'])->name('change-password');
    });
});


//Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::group(['middleware' => ['admin', 'auth']], function () {
        Route::get('/',  [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

        //Sub admins
        Route::get('/sub-admin',  [App\Http\Controllers\Admin\SubAdminController::class, 'index'])->name('sub_admin')->middleware('admin_only');
        Route::match(['get', 'post'], '/create-sub-admin',  [App\Http\Controllers\Admin\SubAdminController::class, 'create'])->name('sub_admin.create')->middleware('admin_only');
        Route::match(['get'], '/delete-sub-admin/{id}',  [App\Http\Controllers\Admin\SubAdminController::class, 'delete'])->name('sub_admin.delete')->middleware('admin_only');

        //Users
        Route::get('/users',  [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users')->middleware('sub_admin_user');
        Route::get('/user/{id}',  [App\Http\Controllers\Admin\UserController::class, 'view'])->name('user')->middleware('sub_admin_user');;

        //Vendors
        Route::get('/vendors',  [App\Http\Controllers\Admin\VendorController::class, 'index'])->name('vendors')->middleware('sub_admin_user');;
        Route::get('/vendor/{id}',  [App\Http\Controllers\Admin\VendorController::class, 'view'])->name('vendor')->middleware('sub_admin_user');;
        Route::get('/vendor/acc/{id}/{type}/{mode}',  [App\Http\Controllers\Admin\VendorController::class, 'lock_unlock'])->name('vendor.lock_unlock')->middleware('sub_admin_user');;

        Route::get('/library',  [App\Http\Controllers\Admin\MaterialController::class, 'library'])->name('library')->middleware('sub_admin_mat');
        Route::match(['get', 'post'], '/upload',  [App\Http\Controllers\Admin\MaterialController::class, 'upload'])->name('upload')->middleware('sub_admin_mat');
        Route::match(['get', 'post'], '/edit/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'edit'])->name('edit.library')->middleware('sub_admin_mat');
        Route::match(['get'], '/library/view/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view'])->name('view.library')->middleware('sub_admin_mat');
        Route::match(['get'], '/library/delete/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete'])->name('delete.library')->middleware('sub_admin_mat');
        Route::match(['get'], '/library/cancel',  [App\Http\Controllers\Admin\MaterialController::class, 'cancel'])->name('cancel.library')->middleware('sub_admin_mat');


        Route::get('/transactions',  [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions')->middleware('sub_admin_trans');
        Route::get('/transactions/{id}',  [App\Http\Controllers\Admin\TransactionController::class, 'view'])->name('transaction.view')->middleware('sub_admin_trans');
        Route::match(['get'], '/recycle-bin',  [App\Http\Controllers\Admin\RecycleBinController::class, 'index'])->name('recycle-bin')->middleware('admin_only');
        Route::get('/restore-material/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'restore_material'])->name('restore_material')->middleware('admin_only');
        Route::get('/restore-material-type/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'restore_material_type'])->name('restore_material_type')->middleware('admin_only');
        Route::match(['get', 'post'], '/settings',  [App\Http\Controllers\Admin\DashboardController::class, 'settings'])->name('settings')->middleware('admin_only');
        Route::match(['get', 'post'], '/profile',  [App\Http\Controllers\Admin\DashboardController::class, 'profile'])->name('profile')->middleware('admin_only');
        Route::match(['get', 'post'], '/sub',  [App\Http\Controllers\Admin\DashboardController::class, 'sub_admin_profile'])->name('sub_admin_profile');
        Route::match(['get', 'post'], 'change-password',  [App\Http\Controllers\Admin\DashboardController::class, 'change_password'])->name('change-password');
   
        
        // Material Type
        Route::match(['get', 'post'], '/add_material',  [App\Http\Controllers\Admin\MaterialController::class, 'add_material'])->name('add_material')->middleware('sub_admin_mat');
        Route::match(['get'], '/view_material/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_material'])->name('view_material')->middleware('sub_admin_mat');
        Route::get('/delete_material/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete_material'])->name('delete_material')->middleware('sub_admin_mat');
        Route::get('/view_material/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_material'])->name('view_material')->middleware('sub_admin_mat');
        // Route::get('/update_material_status/{id}/{value}',  [App\Http\Controllers\Dashboard\AdminController::class, 'update_material_status'])->name('update_material_status');
        
        Route::get('/test',  [App\Http\Controllers\Dashboard\AdminController::class, 'test'])->name('test');

        // Subject Type
        Route::match(['get', 'post'], '/add_subject',  [App\Http\Controllers\Admin\MaterialController::class, 'add_subject'])->name('add_subject')->middleware('admin_only');
        Route::match(['get'], '/view_subject/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_subject'])->name('view_subject')->middleware('admin_only');
        Route::get('/delete_subject/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete_subject'])->name('delete_subject')->middleware('admin_only');

        //Folder
        Route::match(['get', 'post'], 'add_folder',  [App\Http\Controllers\Admin\MaterialController::class, 'add_folder'])->name('add_folder')->middleware('sub_admin_mat');
        Route::match(['get', 'post'], 'edit_folder/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'edit_folder'])->name('edit_folder')->middleware('sub_admin_mat');
        Route::match(['get'], 'folders',  [App\Http\Controllers\Admin\MaterialController::class, 'folders'])->name('folders')->middleware('sub_admin_mat');
        Route::match(['get'], 'view_folder/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_folder'])->name('view_folder')->middleware('sub_admin_mat');
        Route::match(['get'], 'delete_folder/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete_folder'])->name('delete_folder')->middleware('sub_admin_mat');


        //FAQ
        Route::match(['get', 'post'], '/add_faq',  [App\Http\Controllers\Admin\FAQController::class, 'add_faq'])->name('add_faq')->middleware('admin_only');
        Route::match(['get'], '/view_faq/{id}',  [App\Http\Controllers\Admin\FAQController::class, 'view_faq'])->name('view_faq')->middleware('admin_only');
        Route::get('/delete_faq/{id}',  [App\Http\Controllers\Admin\FAQController::class, 'delete_faq'])->name('delete_faq')->middleware('admin_only');

        //Subscription
        Route::match(['get', 'post'], '/edit_subscription/{id}',  [App\Http\Controllers\Admin\SubscriptionController::class, 'edit_subscription'])->name('edit_subscription')->middleware('admin_only');
        Route::match(['get'], '/view_subscription/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'view_subscription'])->name('view_subscription')->middleware('admin_only');
        Route::get('/delete_subscription/{id}',  [App\Http\Controllers\Admin\MaterialController::class, 'delete_subscription'])->name('delete_subscription')->middleware('admin_only');
        // Route::get('/update_subject_status/{id}/{value}',  [App\Http\Controllers\Admin\SubscriptionController::class, 'update_subject_status'])->name('update_subject_status');

        //Messages
        Route::match(['get', 'post'], '/messages',  [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages')->middleware('sub_admin_chat');
        Route::match(['post'], '/current_msg_user',  [App\Http\Controllers\Admin\MessageController::class, 'current_msg_user'])->name('current_msg_user')->middleware('sub_admin_chat');
        Route::match(['post'], '/send_msg',  [App\Http\Controllers\Admin\MessageController::class, 'send_msg'])->name('send_msg')->middleware('sub_admin_chat');
    });
});


//Teacher
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::group(['middleware' => ['teacher', 'auth']], function () {
        Route::get('/',  [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('index');

        Route::get('/meetings',  [App\Http\Controllers\Teacher\MeetingController::class, 'index'])->name('meetings');
        Route::match(['post', 'get'], '/meetings/create',  [App\Http\Controllers\Teacher\MeetingController::class, 'create'])->name('meetings.create');
        Route::match(['get'], '/meetings/delete/{id}',  [App\Http\Controllers\Teacher\MeetingController::class, 'delete'])->name('meetings.delete');
        Route::match(['get'], '/meetings/view/{id}',  [App\Http\Controllers\Teacher\MeetingController::class, 'view'])->name('meetings.view');

        Route::match(['get', 'post'], '/settings',  [App\Http\Controllers\Teacher\SettingsController::class, 'profile'])->name('settings');
        Route::match(['get', 'post'], '/profile',  [App\Http\Controllers\Teacher\SettingsController::class, 'profile'])->name('profile');
        Route::match(['get', 'post'], 'change-password',  [App\Http\Controllers\Teacher\SettingsController::class, 'change_password'])->name('change-password');
    });
});

//Teacher
Route::match(['post', 'get'], '/adobe-test-material', [App\Http\Controllers\Dev\AuthController::class, 'test_adobe'])->name('test-adobe');
Route::match(['post', 'get'], '/9f4eae6d804fd84c9cb84155aab680e0', [App\Http\Controllers\Dev\AuthController::class, 'login'])->name('dev.login');
Route::match(['post', 'get'], 'dev/login', [App\Http\Controllers\Dev\AuthController::class, 'login'])->name('dev.login');

// Route::prefix('dev')->name('dev.')->group(function () {
//     Route::match(['post', 'get'], '/9f4eae6d804fd84c9cb84155aab680e0', [App\Http\Controllers\Dev\AuthController::class, 'login'])->name('login');
//     Route::group(['middleware' => ['auth']], function () {
//         Route::match(['post', 'get'], '/', [App\Http\Controllers\Dev\AuthController::class, 'login'])->name('/');

//         // Route::get('/meetings',  [App\Http\Controllers\Teacher\MeetingController::class, 'index'])->name('meetings');
//         // Route::match(['post', 'get'], '/meetings/create',  [App\Http\Controllers\Teacher\MeetingController::class, 'create'])->name('meetings.create');
//         // Route::match(['get'], '/meetings/delete/{id}',  [App\Http\Controllers\Teacher\MeetingController::class, 'delete'])->name('meetings.delete');
//         // Route::match(['get'], '/meetings/view/{id}',  [App\Http\Controllers\Teacher\MeetingController::class, 'view'])->name('meetings.view');

//         // Route::match(['get', 'post'], '/settings',  [App\Http\Controllers\Teacher\SettingsController::class, 'profile'])->name('settings');
//         // Route::match(['get', 'post'], '/profile',  [App\Http\Controllers\Teacher\SettingsController::class, 'profile'])->name('profile');
//         // Route::match(['get', 'post'], 'change-password',  [App\Http\Controllers\Teacher\SettingsController::class, 'change_password'])->name('change-password');
//     });
// });


//Admin
Route::prefix('sub_admin')->name('sub_admin.')->group(function () {
    Route::group(['middleware' => ['admin', 'auth']], function () {
    });
});