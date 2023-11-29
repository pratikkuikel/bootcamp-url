<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomepageController::class, 'index'])->name('home');

// list all urls
Route::get('/urls', [UrlController::class, 'index'])->name('urls');

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
