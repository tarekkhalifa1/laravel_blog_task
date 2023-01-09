<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('post/{id}', [HomeController::class, 'show'])->name('post.show');


Route::prefix('dashboard')->middleware('auth')->name('dashboard')->group(function () {
    Route::get('/', function () {
        if (Auth::user()->type === 'guest') {
            return redirect('/');
        }
        return view('dashboard.home');
    });
    Route::get('authors/create', [AuthorController::class, 'create'])->name('.author.create');
    Route::post('authors/store', [AuthorController::class, 'store'])->name('.author.store');
    Route::get('deleted/posts', [PostController::class, 'deletedPosts'])->name('.deleted.posts');
    Route::resource('posts', PostController::class, [
        'names' => [
            'index' => '.posts.index',
            'create' => '.posts.create',
            'store' => '.posts.store',
            'edit' => '.posts.edit',
            'update' => '.posts.update',
            'destroy' => '.posts.destroy',
        ]
    ]);
});

Route::resource('comments', CommentController::class, [
    'names' => [
        'store' => 'comments.store'
    ]
]);
