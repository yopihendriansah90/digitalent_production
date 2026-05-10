<?php

use App\Http\Controllers\Frontend\CompanyProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CompanyProfileController::class, 'home'])->name('home');
Route::get('/about', [CompanyProfileController::class, 'about'])->name('about');
Route::get('/services', [CompanyProfileController::class, 'services'])->name('services');
Route::get('/contact', [CompanyProfileController::class, 'contact'])->name('contact');
Route::post('/contact', [CompanyProfileController::class, 'submitContact'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

Route::get('/vision-mission', [CompanyProfileController::class, 'visionMission'])->name('vision-mission');
Route::get('/portfolio', [CompanyProfileController::class, 'portfolio'])->name('portfolio');
Route::get('/training', [CompanyProfileController::class, 'training'])->name('training');
Route::get('/outsourcing', [CompanyProfileController::class, 'outsourcing'])->name('outsourcing');
