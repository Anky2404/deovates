<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ServiceController;
use Illuminate\Support\Facades\Route;

Route::name('front.')->group(function(){
/* ================= HOME ================= */
Route::get('/', [HomeController::class, 'index'])->name('home.index');



/* ================= SERVICES ================= */
Route::prefix('services')->controller(ServiceController::class)->name('services.')->group(function(){
Route::get('/', 'index')->name('index');
Route::get('/{slug}', 'details')->name('details');
});


});

Route::get('/about', function () {
    return view('front.about.index');
})->name('front.about.index');

Route::get('/projects', function () {
    return view('front.portfolios.index');
})->name('front.projects.index');



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
