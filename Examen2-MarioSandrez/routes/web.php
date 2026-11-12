<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
Route::post('/logout', fn () => redirect()->route('dashboard'))->name('logout');