<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampahController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sampahs', [SampahController::class, 'index'])->name('index');
Route::post('/sampahs/tambah-data', [SampahController::class, 'store'])->name('store');
Route::get('/sampahs/{id}', [SampahController::class, 'show'])->name('show');
Route::patch('/sampahs/{id}/update', [SampahController::class, 'update'])->name('update');
Route::delete('/sampahs/{id}/delete', [SampahController::class, 'destroy'])->name('destroy');
Route::get('/sampahs/show/trash', [SampahController::class, 'trash'])->name('trash');
Route::get('/sampahs/show/trash/{id}', [SampahController::class, 'restore'])->name('restore');
Route::get('/sampahs/show/trash/permanent/{id}', [SampahController::class, 'permanentDelete'])->name('permanentDelete');