<?php

use App\Livewire\Index\Whats;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('in', Whats::class)->name('in')->middleware('auth');
Route::get('login', Login::class)->name('login');
