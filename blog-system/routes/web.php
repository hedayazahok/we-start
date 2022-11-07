<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PostControllerUser;
use Illuminate\Support\Facades\Route;
use App\Models\Post;




Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('posts', PostController::class);
    Route::put('posts/update', [PostController::class, 'update'])->name('posts.updatePost');



});


Route::get('/', function ()
{
    $posts=Post::paginate(25);
    return view('index')->with('posts',$posts);
})->name('welcome');


Route::get('post/{id}', [PostControllerUser::class, 'show'])->name('post.show');



