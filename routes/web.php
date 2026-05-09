<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/services', 'pages.services')->name('services');
Route::view('/vision-mission', 'pages.vision-mission')->name('vision-mission');
Route::view('/portfolio', 'pages.portfolio')->name('portfolio');
Route::view('/training', 'pages.training')->name('training');
Route::view('/outsourcing', 'pages.outsourcing')->name('outsourcing');
Route::view('/contact', 'pages.contact')->name('contact');
