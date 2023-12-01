<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('register', [AuthController::class, 'register_page'])->name('auth.register');
Route::post('register',[AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'login_page'])->name('login');
Route::post('login',[AuthController::class, 'login']);

Route::get('/', [HomepageController::class, 'index'])->name('home');

// list all urls
Route::get('/urls', [UrlController::class, 'index'])->name('urls');

// view individual url
Route::get('/urls/{id}', [UrlController::class, 'view'])->name('urls.view');

// create new url
Route::get('/urls/create', [UrlController::class, 'create'])->name('urls.create');

// store a new url
Route::post('/urls/create', [UrlController::class, 'store']);

// Edit existing url
Route::get('/urls/edit/{id}', [UrlController::class, 'edit'])->name('urls.edit');

// update existing url
Route::post('/urls/edit/{id}', [UrlController::class, 'update']);

// delete the url
Route::post('/urls/delete/{id}', [UrlController::class, 'destroy'])->name('urls.destroy');


// routes for short url
Route::get('/{short_url}', [UrlController::class, 'redirect']);
