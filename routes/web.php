<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditLogController;

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/logs', [AuditLogController::class, 'index'])
        ->name('admin.logs');

});
require __DIR__.'/auth.php';
