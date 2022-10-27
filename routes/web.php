<?php

use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FoldersController;
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

// Route::POST('/basefolder/create', [App\Http\Controllers\FoldersController::class, 'CreateBaseFolder'])->name('Basefolder.create');


Route::POST('/folder/create', [App\Http\Controllers\FoldersController::class, 'CreateFolder'])->name('folder.create');

// Route::PUT('/folder/update/{id}', [App\Http\Controllers\FoldersController::class, 'renameBaseFolder'])->name('Basefolder.rename');
Route::PUT('/basefolder/manage/{id}', [App\Http\Controllers\FoldersController::class, 'manageBaseFolder'])->name('Basefolder.manage');


Route::resource('/admin/users', UsersController::class)->middleware('role:admin');

Route::POST('/file/upload', [App\Http\Controllers\FilesController::class, 'upload'])->name('file.upload');


// Base Folder
Route::get('/basefolder/show/{id}', [FoldersController::class, 'show'])->name('basefolder.show');

Route::get('/basefolder/rename/{id}', [FoldersController::class, 'showRename'])->name('basefolder.rename');
Route::PUT('/basefolder/storerename/{id}', [FoldersController::class, 'storeRename'])->name('basefolder.storerename');


Route::get('/basefolder/create', [FoldersController::class, 'create'])->name('basefolder.create');
Route::POST('/basefolder/store', [FoldersController::class, 'store'])->name('basefolder.store');

Route::get('/basefolder/delete/{id}', [FoldersController::class, 'showDelete'])->name('basefolder.showdelete');
Route::DELETE('/basefolder/delete/{id}', [FoldersController::class, 'delete'])->name('basefolder.delete');

Route::get('/basefolder/manage/{id}', [App\Http\Controllers\FoldersController::class, 'showManage'])->name('basefolder.manage');
Route::PUT('/basefolder/storemanage/{id}', [FoldersController::class, 'storeManage'])->name('basefolder.storemanage');



Route::get('/request/{id}', [FoldersController::class, 'askRequest'])->name('request');
