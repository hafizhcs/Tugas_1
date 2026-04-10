<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/profil');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});