<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NinoController;
use App\Http\Controllers\PersonalController;


// Ruta principal (Login)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Desactivar el registro automático de Laravel
Auth::routes(['register' => false]);

// Ruta única para Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas de vistas estáticas
Route::view('/servicios', 'servicios')->name('servicios');

// Rutas de registro (fuera del middleware de autenticación)
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');

// Middleware para proteger todas las rutas de usuarios autenticados
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestión de clientes
Route::resource('clientes', ClienteController::class);

    // Middleware por rol (verifica que lo tengas en Kernel.php)
Route::middleware(['role:administrador'])->group(function () {
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    });
Route::middleware(['role:empleado'])->group(function () {
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    });

Route::middleware(['role:cajero'])->group(function () {
Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
    });

Route::get('/registro/ninos', [NinoController::class, 'index'])->name('ninos.index');
Route::resource('ninos', NinoController::class);
Route::get('/ninos/{nino}', [NinoController::class, 'show'])->name('ninos.show');


Route::middleware(['auth'])->group(function () {
    // Listar el personal
    Route::get('/personal', [PersonalController::class, 'index'])->name('personal.index');

    // Editar personal (Solo accesible para administradores)
    Route::middleware(['admin'])->group(function () {
        Route::get('/personal/{id}/edit', [PersonalController::class, 'edit'])->name('personal.edit');
        Route::put('/personal/{id}', [PersonalController::class, 'update'])->name('personal.update');
    });
});

Route::middleware(['auth'])->group(function () {
    // Listar el personal
    Route::get('/personal', [PersonalController::class, 'index'])->name('personal.index');
});

Route::middleware(['auth', 'administrador'])->group(function () {
    Route::get('/personal', [PersonalController::class, 'index'])->name('personal.index');
    Route::get('/personal/{id}/edit', [PersonalController::class, 'edit'])->name('personal.edit');
    Route::put('/personal/{id}', [PersonalController::class, 'update'])->name('personal.update');
});

});
