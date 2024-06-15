<?php

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

Route::get('/', 'Web\HomeController@index')->name('home');

Route::get('search', 'Web\SearchController@search')->name('search');

// Mailwizz
Route::post('subscribe', 'Mailwizz\MailwizzController@subscribe')->name('subscribe');
Route::get('sendmail', 'Mailwizz\MailwizzController@sendMail')->name('sendmail');
// Route::get('getpost', ['as' => 'getpost', 'uses' => 'web\SearchController@getLatestPosts']);

// Admin Panel Routes

Auth::routes(['register' => false]);

Route::get('/admin', 'Admin\HomeController@index')->name('admin')->middleware('auth');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('user', 'Admin\UserController')->except('show');

    // Page
    Route::resource('page', 'Admin\PageController')->except('show');
    Route::post('admin/page/bulkaction', 'Admin\PageController@bulkAction')->name('admin.page.bulkaction');

    Route::get('profile', 'Admin\ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'Admin\ProfileController@update')->name('profile.update');
    Route::put('profile/password', 'Admin\ProfileController@password')->name('profile.password');

    // Media Routes
    Route::get('media', 'Media\MediaController@index')->name('media');

    Route::post('media/upload', 'Media\MediaController@store')->name('upload.media');
    Route::post('delete_image/{id}', 'Media\MediaController@destroy');
    Route::get('media/get-item/{id}/{size?}', 'Media\MediaController@getItem')->name('media.get');
    Route::get('media/get-all-item/{ids}', 'Media\MediaController@getAllItem');
    Route::get('media/all/{size?}', 'Media\MediaController@getAll')->name('media.all');

    // Menu
    Route::get('menu', 'Admin\MenuController@index')->name('menu');

    // Home Page Setting
    Route::get('home-page-setting', 'Admin\SettingController@home_setting')->name('home-page-setting');
    Route::post('home-page-setting-update', 'Admin\SettingController@home_setting_update')->name('home-page-setting-update');

    // Search Page Setting
    Route::get('search-page-setting', 'Admin\SettingController@search_setting')->name('search-page-setting');
    Route::post('search-page-setting-update', 'Admin\SettingController@search_setting_update')->name('search-page-setting-update');

    Route::get('web-setting', 'Admin\SettingController@web_setting')->name('web-setting');
    Route::post('web-setting-update', 'Admin\SettingController@web_setting_update')->name('web-setting-update');

    Route::post('home-ocn-update', 'Admin\SettingController@home_ocn_update')->name('home-ocn-update');
    Route::post('search-ocn-update', 'Admin\SettingController@search_ocn_update')->name('search-ocn-update');

    // Mailwizz Settings
    Route::get('mailwizz-settings', 'Admin\SettingController@mailwizzSetting')->name('mailwizz-settings');
    Route::post('mailwizz-settings-update', 'Admin\SettingController@mailwizzSettingUpdate')->name('mailwizz-settings-update');

});

Route::get('{slug}', 'Web\PageController@index')->name('page-layout');
