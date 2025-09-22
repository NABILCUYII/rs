<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TindakanController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    //user management
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    //tindakan management
    Route::get('/tindakan', [TindakanController::class, 'index'])->name('tindakan.index');
    Route::get('/tindakan/create', [TindakanController::class, 'create'])->name('tindakan.create');
    Route::get('/tindakan/{user}', [TindakanController::class, 'show'])->name('tindakan.show');
    Route::post('/tindakan', [TindakanController::class, 'store'])->name('tindakan.store');
    Route::put('/tindakan/{user}', [TindakanController::class, 'update'])->name('tindakan.update');
    Route::delete('/tindakan/{user}', [TindakanController::class, 'destroy'])->name('tindakan.destroy');

  
});

require __DIR__.'/auth.php';
