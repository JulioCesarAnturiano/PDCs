<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\AuthController;

// Admin
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\VotoUsuarioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VotoTipoEleccionController;

// Módulos
use App\Http\Controllers\VotoGeograficoController;
use App\Http\Controllers\VotoMesaController;
use App\Http\Controllers\VotosController;

/*
|--------------------------------------------------------------------------
| PÚBLICO
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect()->route('login'));

Route::view('/resultados', 'admin.auth.resultados')
    ->name('resultado.publico');

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN (MISMA LÓGICA QUE EL SISTEMA QUE FUNCIONA)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/admin/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'role:admin|operador'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        /*
        |--------------------------------------------------------------------------
        | USUARIOS (SOLO ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::get('/usuarios', [VotoUsuarioController::class, 'index'])
            ->middleware('permission:admin.usuarios.ver')
            ->name('admin.usuarios.index');

        Route::get('/usuarios/crear', [VotoUsuarioController::class, 'create'])
            ->middleware('permission:admin.usuarios.crear')
            ->name('admin.usuarios.crear');

        Route::post('/usuarios', [VotoUsuarioController::class, 'store'])
            ->middleware('permission:admin.usuarios.crear')
            ->name('admin.usuarios.guardar');

        Route::get('/usuarios/{id}/editar', [VotoUsuarioController::class, 'edit'])
            ->middleware('permission:admin.usuarios.editar')
            ->name('admin.usuarios.editar');

        Route::put('/usuarios/{id}', [VotoUsuarioController::class, 'update'])
            ->middleware('permission:admin.usuarios.editar')
            ->name('admin.usuarios.actualizar');

        Route::delete('/usuarios/{id}', [VotoUsuarioController::class, 'destroy'])
            ->middleware('permission:admin.usuarios.eliminar')
            ->name('admin.usuarios.eliminar');

        /*
        |--------------------------------------------------------------------------
        | ROLES (SOLO ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::get('/roles', [RoleController::class, 'index'])
            ->middleware('permission:admin.roles.ver')
            ->name('admin.roles.index');

        /*
        |--------------------------------------------------------------------------
        | TIPO ELECCIÓN
        |--------------------------------------------------------------------------
        */
        Route::get('/tipo-eleccion', [VotoTipoEleccionController::class, 'index'])
            ->middleware('permission:admin.tipo_eleccion.ver')
            ->name('admin.tipo_eleccion.index');

        Route::get('/tipo-eleccion/crear', [VotoTipoEleccionController::class, 'create'])
            ->middleware('permission:admin.tipo_eleccion.crear')
            ->name('admin.tipo_eleccion.crear');

        Route::post('/tipo-eleccion', [VotoTipoEleccionController::class, 'store'])
            ->middleware('permission:admin.tipo_eleccion.crear')
            ->name('admin.tipo_eleccion.guardar');

        Route::get('/tipo-eleccion/{id}/editar', [VotoTipoEleccionController::class, 'edit'])
            ->middleware('permission:admin.tipo_eleccion.editar')
            ->name('admin.tipo_eleccion.editar');

        Route::put('/tipo-eleccion/{id}', [VotoTipoEleccionController::class, 'update'])
            ->middleware('permission:admin.tipo_eleccion.editar')
            ->name('admin.tipo_eleccion.actualizar');

        Route::delete('/tipo-eleccion/{id}', [VotoTipoEleccionController::class, 'destroy'])
            ->middleware('permission:admin.tipo_eleccion.eliminar')
            ->name('admin.tipo_eleccion.eliminar');

        /*
        |--------------------------------------------------------------------------
        | GEOGRÁFICO
        |--------------------------------------------------------------------------
        */
        Route::get('/geografico', [VotoGeograficoController::class, 'index'])
            ->middleware('permission:admin.geografico.ver')
            ->name('admin.geografico.index');

        Route::get('/geografico/crear', [VotoGeograficoController::class, 'create'])
            ->middleware('permission:admin.geografico.crear')
            ->name('admin.geografico.crear');

        Route::post('/geografico', [VotoGeograficoController::class, 'store'])
            ->middleware('permission:admin.geografico.crear')
            ->name('admin.geografico.guardar');

        Route::get('/geografico/{id}/editar', [VotoGeograficoController::class, 'edit'])
            ->middleware('permission:admin.geografico.editar')
            ->name('admin.geografico.editar');

        Route::put('/geografico/{id}', [VotoGeograficoController::class, 'update'])
            ->middleware('permission:admin.geografico.editar')
            ->name('admin.geografico.actualizar');

        Route::delete('/geografico/{id}', [VotoGeograficoController::class, 'destroy'])
            ->middleware('permission:admin.geografico.eliminar')
            ->name('admin.geografico.eliminar');

        /*
        |--------------------------------------------------------------------------
        | MESAS
        |--------------------------------------------------------------------------
        */
        Route::get('/mesas', [VotoMesaController::class, 'index'])
            ->middleware('permission:admin.mesas.ver')
            ->name('admin.mesas.index');

        Route::get('/mesas/crear', [VotoMesaController::class, 'create'])
            ->middleware('permission:admin.mesas.crear')
            ->name('admin.mesas.crear');

        Route::post('/mesas', [VotoMesaController::class, 'store'])
            ->middleware('permission:admin.mesas.crear')
            ->name('admin.mesas.guardar');

        Route::get('/mesas/{id}/editar', [VotoMesaController::class, 'edit'])
            ->middleware('permission:admin.mesas.editar')
            ->name('admin.mesas.editar');

        Route::put('/mesas/{id}', [VotoMesaController::class, 'update'])
            ->middleware('permission:admin.mesas.editar')
            ->name('admin.mesas.actualizar');

        Route::delete('/mesas/{id}', [VotoMesaController::class, 'destroy'])
            ->middleware('permission:admin.mesas.eliminar')
            ->name('admin.mesas.eliminar');

        /*
        |--------------------------------------------------------------------------
        | VOTOS (ADMIN + OPERADOR)
        |--------------------------------------------------------------------------
        */
        Route::get('/votos', [VotosController::class, 'index'])
            ->middleware('permission:admin.votos.ver')
            ->name('admin.votos.index');

        Route::get('/votos/registrar', [VotosController::class, 'registrar'])
            ->middleware('permission:admin.votos.registrar')
            ->name('admin.votos.registrar');

        Route::post('/votos', [VotosController::class, 'store'])
            ->middleware('permission:admin.votos.registrar')
            ->name('admin.votos.guardar');
    });
