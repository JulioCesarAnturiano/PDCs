<?php

namespace App\Http\Controllers;

use App\Models\VotoMesa;
use App\Models\VotoGeografico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VotoMesaController extends Controller
{
    public function index()
    {
        $items = VotoMesa::with('recinto')->orderBy('id_mesa','desc')->get();
        return view('admin.mesas.index', compact('items'));
    }

    public function create()
    {
        $recintos = VotoGeografico::where('tipo','RECINTO')->orderBy('nombre')->get();
        return view('admin.mesas.create', compact('recintos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => ['required','string','max:50','unique:voto_mesa,codigo'],
            'nombre' => ['nullable','string','max:255'],
            'descripcion' => ['nullable','string'],
            'numero_personas' => ['required','integer','min:0'],
            'id_recinto' => ['required','integer'],
            'activa' => ['required', Rule::in(['0','1',0,1])],
        ]);

        VotoMesa::create($data);

        return redirect()->route('admin.mesas.index')->with('success','Mesa creada.');
    }

    public function edit($id)
    {
        $item = VotoMesa::findOrFail($id);
        $recintos = VotoGeografico::where('tipo','RECINTO')->orderBy('nombre')->get();
        return view('admin.mesas.edit', compact('item','recintos'));
    }

    public function update(Request $request, $id)
    {
        $item = VotoMesa::findOrFail($id);

        $data = $request->validate([
            'codigo' => ['required','string','max:50', Rule::unique('voto_mesa','codigo')->ignore($id,'id_mesa')],
            'nombre' => ['nullable','string','max:255'],
            'descripcion' => ['nullable','string'],
            'numero_personas' => ['required','integer','min:0'],
            'id_recinto' => ['required','integer'],
            'activa' => ['required', Rule::in(['0','1',0,1])],
        ]);

        $item->update($data);

        return redirect()->route('admin.mesas.index')->with('success','Mesa actualizada.');
    }

    public function destroy($id)
    {
        $item = VotoMesa::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.mesas.index')->with('success','Mesa eliminada.');
    }
}
