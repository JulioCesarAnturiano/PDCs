<?php

namespace App\Http\Controllers;

use App\Models\VotoTipoEleccion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VotoTipoEleccionController extends Controller
{
    public function index()
    {
        $tipoElecciones = VotoTipoEleccion::orderBy('id_tipo_eleccion', 'desc')->paginate(10);
        return view('admin.tipo_eleccion.index', compact('tipoElecciones'));
    }

    public function create()
    {
        return view('admin.tipo_eleccion.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required','string','max:255'],
            'codigo' => ['required','string','max:50','unique:voto_tipo_eleccion,codigo'],
        ]);

        VotoTipoEleccion::create($data);

        return redirect()->route('admin.tipo_eleccion.index')->with('success', 'Tipo de elección creado.');
    }

    public function edit($id)
    {
        $item = VotoTipoEleccion::findOrFail($id);
        return view('admin.tipo_eleccion.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = VotoTipoEleccion::findOrFail($id);

        $data = $request->validate([
            'nombre' => ['required','string','max:255'],
            'codigo' => [
                'required','string','max:50',
                Rule::unique('voto_tipo_eleccion','codigo')->ignore($item->id_tipo_eleccion, 'id_tipo_eleccion')
            ],
        ]);

        $item->update($data);

        return redirect()->route('admin.tipo_eleccion.index')->with('success', 'Tipo de elección actualizado.');
    }

    public function destroy($id)
    {
        $item = VotoTipoEleccion::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.tipo_eleccion.index')->with('success', 'Tipo de elección eliminado (soft delete).');
    }
}
