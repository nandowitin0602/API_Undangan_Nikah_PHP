<?php

use App\Http\Controllers\UcapanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/UndanganNikah', [UcapanController::class, 'addUcapan']);
Route::get('/api/UndanganNikah', [UcapanController::class, 'getUcapan']);