<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\KeycloakController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/dashboard', 'dashboard')->middleware('check.session');
Route::get('/login', [KeycloakController::class, 'redirectToKeycloak'])->name('login');
Route::get('/callback', [KeycloakController::class, 'handleKeycloakCallback'])->name('callback');
Route::get('/logout', [KeycloakController::class, 'logout'])->name('logout');