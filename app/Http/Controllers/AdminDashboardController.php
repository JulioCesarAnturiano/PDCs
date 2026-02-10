<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ajusta estos nombres si tus tablas tienen otro nombre real.
        // Yo usé los que mencionaste en rutas / controladores: voto_usuario, voto_tipo_eleccion, geografico, mesas.
        $stats = [
            'usuarios'      => $this->safeCount('voto_usuario'),
            'roles'         => $this->safeCount('roles'), // Spatie
            'tipo_eleccion' => $this->safeCount('voto_tipo_eleccion'),
            'geografico'    => $this->safeCount('voto_geografico'),
            'mesas'         => $this->safeCount('voto_mesas'),
            'votos'         => $this->safeCount('votos'),
        ];

        // Últimos votos (opcional). Si tu tabla se llama distinto, cambia 'votos'.
        $latest = $this->safeLatest('votos', 6);

        return view('admin.dashboard', compact('stats', 'latest'));
    }

    private function safeCount(string $table): int
    {
        try {
            return (int) DB::table($table)->count();
        } catch (\Throwable $e) {
            return 0;
        }
    }

    private function safeLatest(string $table, int $limit = 6)
    {
        try {
            return DB::table($table)
                ->orderByDesc('id')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            return collect();
        }
    }
}