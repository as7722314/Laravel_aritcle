<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [ArticleController::class, 'index']);


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::controller(ArticleController::class)->group(function () {
            Route::get('/dashboard', 'getAll')->name('dashboard');
            Route::get('/article/create', 'create');
            Route::post('/article/store', 'store');
            Route::get('/article/show_update/{id}',  'getArticleById');
            Route::get('/article/delete/{id}',  'deleteArticleById');
            Route::put('/article/do_update/{id}',  'updateArticleByid');
        });

        Route::controller(CommentController::class)->group(function () {
            Route::get('/comment/{article_id}/article', 'getCommentsByArticleId');
            Route::post('/comment/store', 'storeComment');
            Route::put('/comment/update', 'updateComment');
            Route::delete('/comment/{comment_id}/{article_id}', 'deleteCommentById');
        });
    });
