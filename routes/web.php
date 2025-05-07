<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/Formulario' , [QRController::class, 'index'])->name('Formulario');
Route::post('/qr/Generar' , [QRController::class, 'Generar'])->name('qr.Generar');
// Route::post('/qr/descargar' , [QRController::class, 'Download'])->name('qr.descargar');
Route::match(['get', 'post'] , '/qr/descargar' , [QRController::class, 'Download'])->name('qr.descargar');

