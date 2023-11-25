<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('/profile')->middleware('can:permission')->group(function()
    {
        Route::get('/edit/{userId}', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/edit/{userid}',[ProfileController::class, 'editSave'])->name('editSave');
        Route::post('/register',[ProfileController::class, 'register'])->name('register');
        Route::get('/profile', [ProfileController::class, 'indexProfile'])->name('indexProfile');
    });
    Route::post('/insertFile',[UploadController::class, 'insertFile'])->name('insertFile');
    Route::get('/approve/{approve}', [UploadController::class, 'approve'])->name('approve');
    Route::get('/reject/{reject}', [UploadController::class, 'reject'])->name('reject');
    Route::get('/upload', [UploadController::class, 'showUpload'])->name('showUpload')->middleware('can:permission');
    Route::get('/pending', [UploadController::class, 'showPending'])->name('showPending');
    Route::get('/index', [UploadController::class, 'showIndex'])->name('showIndex');
    Route::post('/status/{userId}',[ProfileController::class, 'status'])->name('status');
});

;

require __DIR__.'/auth.php';
