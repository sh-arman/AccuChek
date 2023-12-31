<?php


use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\TemplateController;

/*
|--------------------------------------------------------------------------
|   Author: Shajedul Hasan Arman - armanhassan504@gmail.com
|--------------------------------------------------------------------------
|   Laravel Framework 9.17.0
|   Composer version 2.3.7 2022-06-06
|   PHP 8.1.4
|   Auth Custom - Bootstrap - 5 [ vendor->laravel->ui->auth-backend ]
*/

// Clear
Route::get('/clear', function() {
    // Artisan::call('route:cache');
    Artisan::call('config:clear');
    // Artisan::call('config:cache');
    // Artisan::call('view:clear');
    // Artisan::call('view:cache');
    // Artisan::call('cache:clear');
    // Artisan::call('optimize:clear');
    // Artisan::call('optimize');
    dd("Cache Clear All");
});
// session locale setting --------------------------------------------------------------------------------------
Route::get('/set-locale/{locale}', [CheckController::class, 'locale'])->name('locale.setting');
// livecheck  ---------------------------------------------------------------------------------------------------
Route::get('/', function(){
    App::setLocale(session('locale'));
    return view('livecheck.livecheck');
});
Route::post('/codeVerify', [CheckController::class, 'codeVerify'])->name('codeVerify');
Route::post('/phoneVerify', [CheckController::class, 'phoneVerify'])->name('phoneVerify');
Route::post('/liveCheck', [CheckController::class, 'liveCheck'])->name('liveCheck');
// Auth  --------------------------------------------------------------------------------------------------------
// Auth::routes();
// Route::post('/custom-login', [Controller::class, 'custom_login'])->name('custom_login');
// Route::post('/custom-register', [Controller::class, 'custom_register'])->name('custom_register');



Route::post('/search_code', [CheckController::class, 'search_code'])->name('search_code');

// Route::group(['prefix' => 'admin'], function() {
Route::group(['prefix' => 'admin','middleware' => ['auth','SessionLogout']], function() {
    // Dashboard -------------------------------------------------------------------------------------------------
    Route::view('/dashboard', 'admin.index')->name('dashboard');
    // Order -----------------------------------------------------------------------------------------------------
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order-store', [OrderController::class, 'store'])->name('order_store');
    // Track  ----------------------------------------------------------------------------------------------------
    Route::get('/track', [TrackController::class, 'index'])->name('track');
    // Support  --------------------------------------------------------------------------------------------------
    Route::view('/support', 'admin.support')->name('support');
    // Analytic  -------------------------------------------------------------------------------------------------
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::post('/analytics_search', [AnalyticsController::class, 'search'])->name('analytics_search');
    Route::get('/analytics_search_lastyear', [AnalyticsController::class, 'lastyear'])->name('analytics_search_lastyear');
    Route::post('/analytics_csv', [AnalyticsController::class, 'csv'])->name('analytics_csv');
    // Only panacea admin access  --------------------------------------------------------------------------------
    Route::middleware(['PanaceaCheck'])->group(function () {
        // tamplate  ---------------------------------------------------------------------------------------------
        Route::get('/template', [TemplateController::class, 'index'])->name('template');
        Route::post('/template-store', [TemplateController::class, 'store'])->name('template_store');
        Route::post('/template-update/{id}', [TemplateController::class, 'update'])->name('template_update');
        Route::get('/template-delete/{id}', [TemplateController::class, 'delete'])->name('template_delete');
        // Users -------------------------------------------------------------------------------------------------
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::post('/users-update/{id}', [UserController::class, 'update'])->name('user_update');
        Route::post('/users-delete/{id}', [UserController::class, 'delete'])->name('user_delete');
        // Track  ------------------------------------------------------------------------------------------------
        Route::post('/track-delete', [TrackController::class, 'delete'])->name('track_delete');
    });

});

