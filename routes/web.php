<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthenticatedViewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/applications', [AuthenticatedViewController::class, 'index'])->name('dashboard');
    Route::get('/applications/create', [AuthenticatedViewController::class, 'create'])->name('application.create');
    Route::get('/applications/application-{slug}', [AuthenticatedViewController::class, 'show'])->name('application.show');
    Route::post('/applications/store', [AuthenticatedViewController::class, 'store'])->name('application.store');
    Route::put('/applications/application-{slug}', [AuthenticatedViewController::class, 'update'])->name('application.update');
    Route::delete('/applications/application-{slug}', [AuthenticatedViewController::class, 'destroy'])->name('application.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
