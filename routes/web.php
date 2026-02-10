<?php
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\VotoUsuarioController;
use App\Http\Controllers\Admin\RoleController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Usuarios (VotoUsuario)
        Route::resource('usuarios', VotoUsuarioController::class)->except(['show']);

        // Roles (Spatie)
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');

        // (Los demás módulos los dejamos para después)
    });
