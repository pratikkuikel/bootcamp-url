<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::get('contact', function () {
        return view('contact');
    });

    Route::get('urls', function () {
        return view('urls');
    });

    Route::get('/middleware-test', function () {
        return 'hey';
    });

    Route::get('/', [HomepageController::class, 'index']);
});


// Route::get('/', function () {
//     return view('welcome');
// });
