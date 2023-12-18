<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HttpController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/datetime', function () {
    $date = new Carbon('first day of December 2016');
    // $date = Carbon::now();
    // $date->today();
    $manipulated_date = $date->shortAbsoluteDiffForHumans();

    // $date = Carbon::tomorrow();
    return $manipulated_date;
});

// Test Http client
Route::get('/http', [HttpController::class, 'index']);
Route::get('/post', [HttpController::class, 'post_request']);

// Authentication Routes
Route::get('register', [AuthController::class, 'register_page'])->name('auth.register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'login_page'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Logout route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomepageController::class, 'index'])->name('home');

// email verification routes
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/urls');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('profile', [AuthController::class, 'update_profile']);

    // list all urls
    Route::get('/urls', [UrlController::class, 'index'])->name('urls');

    // view individual url
    Route::get('/urls/view/{id}', [UrlController::class, 'view'])->name('urls.view');

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
});

// file upload
Route::get('file-upload', [HomepageController::class, 'upload_page'])->name('file.upload');
Route::post('file-upload', [HomepageController::class, 'upload']);

// routes for short url
Route::get('/{short_url}', [UrlController::class, 'redirect']);
