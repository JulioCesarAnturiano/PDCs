<?php

namespace App\Http\Controllers;

use App\Models\VotoMesa;
use App\Models\VotoTipoEleccion;
use Illuminate\Http\Request;

class VotosController extends Controller
{
    public function index()
    {
        // Si aún no existe tabla votos, manda vacío.
        $items = [];
        return view('admin.votos.index', compact('items'));
    }

    public function registrar()
    {
        $mesasActivas = VotoMesa::where('activa', 1)->orderBy('codigo')->get();
        $tipos = VotoTipoEleccion::orderBy('nombre')->get();

        return view('admin.votos.registrar', compact('mesasActivas','tipos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_mesa' => ['required','integer'],
            'id_tipo_eleccion' => ['required','integer'],
            'votos_validos' => ['required','integer','min:0'],
            'votos_nulos' => ['required','integer','min:0'],
            'observacion' => ['nullable','string'],
        ]);

        // Aquí luego guardan en la tabla real de votos (cuando exista).
        // Por ahora, dejamos el flujo OK:
        return redirect()->route('admin.votos.registrar')->with('success', 'Registro recibido (pendiente de persistencia en tabla votos).');
    }
}
