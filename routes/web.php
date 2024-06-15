<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Mailwizz;
use App\Http\Controllers\Media;
use App\Http\Controllers\Web;
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

// Website Routes

Route::get('/', [Web\HomeController::class, 'index'])->name('home');

Route::get('search', [Web\SearchController::class, 'search'])->name('search');

// Mailwizz
Route::post('subscribe', [Mailwizz\MailwizzController::class, 'subscribe'])->name('subscribe');
Route::get('sendmail', [Mailwizz\MailwizzController::class, 'sendMail'])->name('sendmail');
// Route::get('getpost', ['as' => 'getpost', 'uses' => 'web\SearchController@getLatestPosts']);

// Admin Panel Routes

Auth::routes(['register' => false]);

Route::get('/admin', [Admin\HomeController::class, 'index'])->name('admin')->middleware('auth');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('user', Admin\UserController::class)->except('show');

    // Page
    Route::resource('page', Admin\PageController::class)->except('show');
    Route::post('admin/page/bulkaction', [Admin\PageController::class, 'bulkAction'])->name('admin.page.bulkaction');

    Route::get('profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [Admin\ProfileController::class, 'password'])->name('profile.password');

    // Media Routes
    Route::get('media', [Media\MediaController::class, 'index'])->name('media');

    Route::post('media/upload', [Media\MediaController::class, 'store'])->name('upload.media');
    Route::post('delete_image/{id}', [Media\MediaController::class, 'destroy']);
    Route::get('media/get-item/{id}/{size?}', [Media\MediaController::class, 'getItem'])->name('media.get');
    Route::get('media/get-all-item/{ids}', [Media\MediaController::class, 'getAllItem']);
    Route::get('media/all/{size?}', [Media\MediaController::class, 'getAll'])->name('media.all');

    // Menu
    Route::get('menu', [Admin\MenuController::class, 'index'])->name('menu');

    // Home Page Setting
    Route::get('home-page-setting', [Admin\SettingController::class, 'home_setting'])->name('home-page-setting');
    Route::post('home-page-setting-update', [Admin\SettingController::class, 'home_setting_update'])->name('home-page-setting-update');

    // Search Page Setting
    Route::get('search-page-setting', [Admin\SettingController::class, 'search_setting'])->name('search-page-setting');
    Route::post('search-page-setting-update', [Admin\SettingController::class, 'search_setting_update'])->name('search-page-setting-update');

    Route::get('web-setting', [Admin\SettingController::class, 'web_setting'])->name('web-setting');
    Route::post('web-setting-update', [Admin\SettingController::class, 'web_setting_update'])->name('web-setting-update');

    Route::post('home-ocn-update', [Admin\SettingController::class, 'home_ocn_update'])->name('home-ocn-update');
    Route::post('search-ocn-update', [Admin\SettingController::class, 'search_ocn_update'])->name('search-ocn-update');

    // Mailwizz Settings
    Route::get('mailwizz-settings', [Admin\SettingController::class, 'mailwizzSetting'])->name('mailwizz-settings');
    Route::post('mailwizz-settings-update', [Admin\SettingController::class, 'mailwizzSettingUpdate'])->name('mailwizz-settings-update');

});

Route::get('{slug}', [Web\PageController::class, 'index'])->name('page-layout');
