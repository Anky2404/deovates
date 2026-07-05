<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.home.index');
})->name('front.home.index');

Route::get('/about', function () {
    return view('front.about.index');
})->name('front.about.index');

Route::get('/projects', function () {
    return view('front.projects.index');
})->name('front.projects.index');

Route::get('/services', function () {
    return view('front.services.index');
})->name('front.services.index');

Route::get('/blog', function () {
    return view('front.blog.index');
})->name('front.blog.index');
Route::get('/blog/details', function () {
    return view('front.blog.index');
})->name('front.blog.details');

Route::get('/elements', function () {
    return view('front.elements.index');
})->name('front.elements.index');

Route::get('/project-details', function () {
    return view('front.project.details');
})->name('front.project.details');

Route::get('/service-details', function () {
    return view('front.service.details');
})->name('front.service.details');

Route::get('/contact', function () {
    return view('front.contact.index');
})->name('front.contact.index');
