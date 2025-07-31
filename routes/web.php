<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Admin-visit only route

Route::get('/admins-only', function() { 
    return 'Only admins should be able to see this page.';
})->middleware('can:visitAdminPages'); // Use app/provider/AppServiceProvider to set up a 'Gate'

// User related routes

Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login'); // give this route a name

Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');
Route::get('/manage-avatar', [UserController::class, 'showAvatarForm'])->middleware('mustBeLoggedIn');
Route::post('/manage-avatar', [UserController::class, 'storeAvatar'])->middleware('mustBeLoggedIn');

// Blog post related routes

Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('mustBeLoggedIn'); // middelware runs before showCreateForm
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn');

Route::get('/post/{post}', [PostController::class, 'viewSinglePost']); // route model binding
Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('can:delete,post'); // "delete" if the user is authorized 

Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post');
Route::put('/post/{post}', [PostController::class, 'actuallyUpdate'])->middleware('can:update,post');

// Profile related routes

Route::get('/profile/{user:username}', [UserController::class, 'profile']); // use User model to find username in the db and display in the route