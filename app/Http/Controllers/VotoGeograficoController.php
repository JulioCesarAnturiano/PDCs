<?php

namespace App\Http\Controllers;

use App\Models\VotoGeografico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VotoGeograficoController extends Controller
{
    public function index()
    {
        $items = VotoGeografico::orderBy('id_geografico','desc')->get();
        return view('admin.geografico.index', compact('items'));
    }

    public function create()
    {
        $padres = VotoGeografico::orderBy('nombre')->get();
        return view('admin.geografico.create', compact('padres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required','string','max:255'],
            'codigo' => ['required','string','max:50', 'unique:voto_geografico,codigo'],
            'ubicacion' => ['nullable','string','max:255'],
            'tipo' => ['required', Rule::in(['PAIS','CIUDAD','MUNICIPIO','LOCALIDAD','RECINTO'])],
            'fk_id_geografico' => ['nullable','integer'],
        ]);

        VotoGeografico::create($data);

        return redirect()->route('admin.geografico.index')->with('success','Geográfico creado.');
    }

    public function edit($id)
    {
        $item = VotoGeografico::findOrFail($id);
        $padres = VotoGeografico::where('id_geografico','!=',$id)->orderBy('nombre')->get();
        return view('admin.geografico.edit', compact('item','padres'));
    }

    public function update(Request $request, $id)
    {
        $item = VotoGeografico::findOrFail($id);

        $data = $request->validate([
            'nombre' => ['required','string','max:255'],
            'codigo' => ['required','string','max:50', Rule::unique('voto_geografico','codigo')->ignore($id,'id_geografico')],
            'ubicacion' => ['nullable','string','max:255'],
            'tipo' => ['required', Rule::in(['PAIS','CIUDAD','MUNICIPIO','LOCALIDAD','RECINTO'])],
            'fk_id_geografico' => ['nullable','integer'],
        ]);

        $item->update($data);

        return redirect()->route('admin.geografico.index')->with('success','Geográfico actualizado.');
    }

    public function destroy($id)
    {
        $item = VotoGeografico::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.geografico.index')->with('success','Geográfico eliminado.');
    }
}
