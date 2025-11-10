<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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

            Route::get('/page-builder', fn() => Inertia::render('Admin/PageBuilder'))
                ->name('admin.pagebuilder');

            Route::get('/dashboard', fn() => Inertia::render('Admin/Dashboard'))->name('dashboard');
            Route::get('/users', [UserController::class, 'index'])->name('users.index');

            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');

            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
                
            Route::resource('courses', CourseController::class)->except(['show']);
            
            Route::resource('groups', GroupController::class)->except(['show']);
            Route::get('/groups', [GroupController::class, 'index'])->name('groups.index'); // todos los grupos
            Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
            Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
            Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');
            Route::put('/groups/{group}', [GroupController::class, 'update'])->name('groups.update');


            Route::get('/courses/{course}/groups', [GroupController::class, 'byCourse'])->name('courses.groups'); // grupos por curso
            Route::get('/courses/{course}/groups/create', [GroupController::class, 'createFromCourse'])->name('courses.groups.create');

            Route::resource('permissions', PermissionController::class);
            Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])
                ->name('permissions.destroy');

            Route::resource('roles', RoleController::class);

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