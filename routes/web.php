<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VotoGeograficoController;
use App\Http\Controllers\VotoMesaController;
use App\Http\Controllers\VotosController;

// Estos los hará Persona 1 (si aún no existen, comenta estas 4 líneas o crea los controladores)
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\VotoUsuarioController;
use App\Http\Controllers\VotoTipoEleccionController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| PÚBLICO
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::view('/resultados', 'admin.auth.resultado')->name('resultado.publico');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN (requiere sesión)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY (Spatie role:admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {

        // Usuarios
        Route::get('/usuarios', [VotoUsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/create', [VotoUsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [VotoUsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{id}/edit', [VotoUsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [VotoUsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [VotoUsuarioController::class, 'destroy'])->name('usuarios.destroy');

        // Roles
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');



        // Geográfico
        Route::get('/geografico', [VotoGeograficoController::class, 'index'])->name('geografico.index');
        Route::get('/geografico/create', [VotoGeograficoController::class, 'create'])->name('geografico.create');
        Route::post('/geografico', [VotoGeograficoController::class, 'store'])->name('geografico.store');
        Route::get('/geografico/{id}/edit', [VotoGeograficoController::class, 'edit'])->name('geografico.edit');
        Route::put('/geografico/{id}', [VotoGeograficoController::class, 'update'])->name('geografico.update');
        Route::delete('/geografico/{id}', [VotoGeograficoController::class, 'destroy'])->name('geografico.destroy');

        // Mesas
        Route::get('/mesas', [VotoMesaController::class, 'index'])->name('mesas.index');
        Route::get('/mesas/create', [VotoMesaController::class, 'create'])->name('mesas.create');
        Route::post('/mesas', [VotoMesaController::class, 'store'])->name('mesas.store');
        Route::get('/mesas/{id}/edit', [VotoMesaController::class, 'edit'])->name('mesas.edit');
        Route::put('/mesas/{id}', [VotoMesaController::class, 'update'])->name('mesas.update');
        Route::delete('/mesas/{id}', [VotoMesaController::class, 'destroy'])->name('mesas.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | VOTOS (admin o transcriptor)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin|transcriptor'])->group(function () {
        Route::get('/votos', [VotosController::class, 'index'])->name('votos.index');
        Route::get('/votos/registrar', [VotosController::class, 'registrar'])->name('votos.registrar');
        Route::post('/votos', [VotosController::class, 'store'])->name('votos.store');
    });
});
