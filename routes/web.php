<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/curah-cair', function () {
    return view('curahCair.app');
})->name('curah.cair');
Route::get('/curah-kering', function () {
    return view('curahKering.app');
})->name('curah.kering');
Route::get('/peti-kemas', function () {
    return view('petiKemas.app');
})->name('peti.Kemas');
Route::get('/general-Cargo', function () {
    return view('generalCargo.app');
})->name('general.Cargo');

