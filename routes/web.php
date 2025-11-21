<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('signup');
});

Route::get('/login', function () {
    return view('login');
});



Route::view('allposts', 'allposts');
Route::view('addpost', 'addpost');
