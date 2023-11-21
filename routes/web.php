<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomepageController::class,'index']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/asdf', function () {
    return view('contact');
});
