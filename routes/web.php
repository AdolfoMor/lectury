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

// Rutas protegidas por autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Ruta principal según rol
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard'); // Redirige al dashboard admin
        }

        return Inertia::render('User/Home'); // Usuarios normales
    })->name('dashboard');

    // Cambio de contraseña obligatorio
    Route::get('/password/change', function () {
        return Inertia::render('Auth/ChangePassword', [
            'warning' => session('warning'),
        ]);
    })->name('password.change');

    Route::post('/password/change/update', [ChangePasswordController::class, 'update'])
        ->name('password.change.update');

    // Rutas de administrador
    Route::middleware('role:admin') // Solo usuarios con rol admin
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', function () {
                return Inertia::render('Admin/Dashboard');
            })->name('dashboard');


        });

    // Rutas de usuario normal
    Route::prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/home', function () {
                return Inertia::render('User/Home');
            })->name('home');

        });
});