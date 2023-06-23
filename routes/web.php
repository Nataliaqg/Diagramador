<?php

use App\Http\Controllers\Pizarra\ShowPizarra;
use App\Http\Controllers\Pizarra\ShowScripts;
use App\Http\Livewire\GenerarVistas as LivewireGenerarVistas;
use App\Http\Livewire\Pizarra\GenerarScripts;
use App\Http\Livewire\Pizarra\GenerarVistas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ShowPizarra/{id}', [ShowPizarra::class,'index'])->name('showpizarra');
Route::get('/scripts/{id}', [ShowScripts::class,'index'])->name('scripts');
Route::get('/vistas', [LivewireGenerarVistas::class, 'mount'])->name('generarvista');


Route::get('/prueba', function () {
    return view('vistaprueba');
});

