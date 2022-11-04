<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'Moderator'], function () {

    Route::get('/createpost',[PostController::class, 'createpost'])->name('creatpost');
    Route::post('/creatingpost',[PostController::class,'create'])->name('creatingpost');

});

Route::get('/list',[PostController::class,'show'])->name('show');
Route::get('/postdetails/{id}', [PostController::class,'postdetails'])->name('postdetails');

Route::post('/creatingcomment/{id}', [CommentController::class, 'creatingcomment'])->name('creatingcomment');

Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'post'], function () {
        Route::get('/deletepost', [PostController::class, 'delete'])->name('delete');
        Route::get('/delpost/{id}',[PostController::class, 'delpost'])->name('delpost');
        Route::get('/deletepostTrash', [PostController::class, 'deleteTrash'])->name('deleteTrash');
        Route::get('/delpostTrash/{id}',[PostController::class, 'delpostTrash'])->name('delpostTrash');
        Route::get('/restorepostTrash/{id}',[PostController::class, 'restorepostTrash'])->name('restorepostTrash');
    });
    Route::group(['prefix' => 'comment'], function () {
        Route::get('/deletecomment', [CommentController::class, 'deletecomment'])->name('deletecomment');
        Route::get('/delcomment/{id}',[CommentController::class, 'delcomment'])->name('delcomment');
        Route::get('/deletecommentTrash', [CommentController::class, 'deletecommentTrash'])->name('deletecommentTrash');
        Route::get('/delcommentTrash/{id}',[CommentController::class, 'delcommentTrash'])->name('delcommentTrash');
        Route::get('/restorecommentTrash/{id}',[CommentController::class, 'restorecommentTrash'])->name('restorecommentTrash');
    });
    


});
