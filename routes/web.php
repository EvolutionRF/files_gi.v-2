<?php

use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\BaseFoldersController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FoldersController;
use App\Http\Controllers\TrashController;
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

Route::redirect('/home', '/dashboard');
Route::redirect('/', '/dashboard');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/folders/{slug}', [App\Http\Controllers\FoldersController::class, 'EnterFolder'])->name('EnterFolder');


// Route::POST('/folder/create', [App\Http\Controllers\FoldersController::class, 'CreateFolder'])->name('folder.create');


Route::resource('/admin/users', UsersController::class)->middleware('role:admin');

Route::POST('/file/upload', [App\Http\Controllers\FilesController::class, 'upload'])->name('file.upload');


Route::controller(FoldersController::class)->prefix('folder')->group(function () {
    Route::get('/show/{slug}', 'showDetail')->name('folder.show');

    Route::get('/rename/{slug}', 'showRename')->name('folder.rename');
    Route::PUT('/storerename/{slug}', 'storeRename')->name('folder.storerename');


    Route::get('/create/{slug?}', 'create')->name('folder.create');
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


    Route::get('/download/{slug}', 'showDownloadFile')->name('file.showdownload');
    Route::get('/download-file/{slug}', 'downloadFile')->name('file.download');
});

Route::controller(TrashController::class)->prefix('trash')->group(function () {
    Route::get('/', 'index')->name('trash.index');

    Route::get('/restore/{slug}', 'showRestore')->name('trash.showrestore');
    Route::POST('/restore/{slug}', 'storeRestore')->name('trash.restore');

    Route::get('/forceDel/{slug}', 'showForceDelete')->name('trash.showforcedelete');
    Route::DELETE('/forceDel/{slug}', 'storeForceDelete')->name('trash.forcedelete');
});


Route::get('/request/{id}', [FoldersController::class, 'askRequest'])->name('request');
