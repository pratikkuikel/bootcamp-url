<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {

    Route::get('urls', function () {
        return view('urls');
    });

    Route::get('/middleware-test', function () {
        return 'hey';
    });

});

Route::get('/', [HomepageController::class, 'index'])->name('home');

Route::get('contact',[ContactController::class,'index']);

Route::post('/submit-contact',[ContactController::class,'store'])->name('contact.submit');


// Route::get('/', function () {
//     return view('welcome');
// });
