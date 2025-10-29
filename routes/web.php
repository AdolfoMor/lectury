<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChangePasswordController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return Inertia::render('Admin/Dashboard');
        }

        return Inertia::render('User/Home');
    })->name('dashboard');
});

Route::get('/password/change', function () {
    return Inertia::render('Auth/ChangePassword', [
        'warning' => session('warning'),
    ]);
})->name('password.change');

Route::post('/password/change/update', [ChangePasswordController::class, 'update'])
    ->name('password.change.update');