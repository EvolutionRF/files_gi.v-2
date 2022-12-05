<?php

use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\BaseFoldersController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FoldersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SharedController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\URLController;
use App\Http\Controllers\UserController;
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

Auth::routes();


Route::get('/notification', [NotificationController::class, 'index'])->name('notif');
Route::redirect('/home', '/dashboard');
Route::redirect('/', '/dashboard');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/myFiles', [App\Http\Controllers\MyFilesController::class, 'myFiles'])->name('myFiles');


Route::controller(UsersController::class)->prefix('admin/users')->middleware('role:admin')->group(function () {

    Route::get('', 'index')->name('users.index');

    Route::get('/create', 'create')->name('users.create');
    Route::POST('/store', 'store')->name('users.store');


    Route::get('/edit/{id}', 'edit')->name('users.edit');
    Route::PUT('/update/{id}', 'update')->name('users.update');

    Route::get('/delete/{id}', 'showDestroy')->name('users.showdestroy');
    Route::DELETE('/delete/{id}', 'destroy')->name('users.destroy');

    Route::get('/reset-password/{id}', 'showReset')->name('users.showreset');
    Route::PUT('/reset/{id}', 'resetPassword')->name('users.resetpassword');
});




Route::controller(FoldersController::class)->prefix('folders')->group(function () {
    Route::get('/create/{slug?}', 'create')->name('folder.create');


    Route::get('/{slug}', 'EnterFolder')->name('EnterFolder');

    Route::get('/show/{slug}', 'showDetail')->name('folder.show');
    Route::get('/activity/{slug}', 'showActivity')->name('folder.activity');

    Route::get('/rename/{slug}', 'showRename')->name('folder.rename');
    Route::PUT('/storerename/{slug}', 'storeRename')->name('folder.storerename');

    Route::POST('/store', 'store')->name('folder.store');

    Route::get('/delete/{slug}', 'showDelete')->name('folder.showdelete');
    Route::DELETE('/delete/{slug}', 'delete')->name('folder.delete');

    Route::get('/manage/{slug}', 'showManage')->name('folder.manage');
    Route::PUT('/storemanage/{slug}', 'storeManage')->name('folder.storemanage');
});

Route::controller(FilesController::class)->prefix('file')->group(function () {
    Route::get('/create/{slug}', 'showCreate')->name('file.showcreate');
    Route::POST('/store', 'storeCreate')->name('file.storecreate');

    Route::get('/show/{slug}', 'showDetail')->name('file.showdetail');

    Route::get('/manage/{slug}', 'showManage')->name('file.showmanage');
    Route::PUT('/storemanage/{slug}', 'storeManage')->name('file.storemanage');

    Route::get('/rename/{slug}', 'showRename')->name('file.showrename');
    Route::PUT('/storerename/{slug}', 'storeRename')->name('file.storerename');

    Route::get('/delete/{slug}', 'showDelete')->name('file.showdelete');
    Route::DELETE('/delete/{slug}', 'storeDelete')->name('file.delete');

    Route::get('/update/{slug}', 'showUpdate')->name('file.showupdate');
    Route::PUT('/update/{slug}', 'storeUpdate')->name('file.storeupdate');


    Route::get('/download/{slug}', 'showDownloadFile')->name('file.showdownload');
    Route::get('/download-file/{slug}', 'downloadFile')->name('file.download');
});

Route::controller(URLController::class)->prefix('url')->group(function () {
    Route::get('/create/{slug}', 'showCreate')->name('url.showcreate');
    Route::POST('/store', 'storeCreate')->name('url.storecreate');

    Route::get('/show/{slug}', 'showDetail')->name('url.showdetail');
    Route::get('/get/{slug}', 'showURL')->name('url.showurl');
    Route::PUT('/update/{slug}', 'storeUpdate')->name('url.storeupdate');
});

Route::controller(TrashController::class)->prefix('trash')->group(function () {
    Route::get('/', 'index')->name('trash.index');

    Route::get('/restore/{slug}', 'showRestore')->name('trash.showrestore');
    Route::POST('/restore/{slug}', 'storeRestore')->name('trash.restore');

    Route::get('/forceDel/{slug}', 'showForceDelete')->name('trash.showforcedelete');
    Route::DELETE('/forceDel/{slug}', 'storeForceDelete')->name('trash.forcedelete');
});


Route::controller(NotificationController::class)->prefix('notification')->group(function () {
    Route::get('/request/{slug}',  'request')->name('request');
    Route::post('/request/{slug}',  'storeRequest')->name('request.store');

    Route::PUT('/base-request/status/{id}',  'BaseRequestHandler')->name('base-request.status');
    Route::PUT('/content-request/status/{id}',  'ContentRequestHandler')->name('content-request.status');
});


Route::controller(SharedController::class)->prefix('shared')->group(function () {

    Route::get('/', 'index')->name('shared.index');
});

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('/profile', 'editProfile')->name('user.editprofile');
    Route::put('/profile/{id}', 'storeEditProfile')->name('user.storeeditprofile');

    Route::get('/password', 'changePassword')->name('user.changepassword');
    Route::put('/password/{id}', 'storeChangePassword')->name('user.storechangepassword');
});
