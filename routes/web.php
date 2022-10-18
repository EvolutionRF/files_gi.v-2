<?php

use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\FilesController;
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
Route::POST('/basefolder/create', [App\Http\Controllers\FoldersController::class, 'CreateBaseFolder'])->name('Basefolder.create');

Route::POST('/folder/create', [App\Http\Controllers\FoldersController::class, 'CreateFolder'])->name('folder.create');

Route::resource('/admin/users', UsersController::class)->middleware('role:admin');

Route::POST('/file/upload', [App\Http\Controllers\FilesController::class, 'upload'])->name('file.upload');
