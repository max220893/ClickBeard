<?php

namespace App\Http\Controllers;

use App\Models\Barbeiro;
use App\Models\Especialidade;
use Illuminate\Http\Request;

class BarbeiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['barbeiros'] = Barbeiro::all();
        return view('telas.barbeiros.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['especialidades'] = Especialidade::all();
        return view('telas.barbeiros.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255', 'unique:barbeiros'],
            'idade' => ['required', 'int', 'min:18', 'max:100'],
            'data_contratacao' => ['required', 'date'],
        ]);
        $barbeiro = Barbeiro::create($request->all());
        $barbeiro->especialidades()->attach($request->especialidades);
        return redirect('barbeiros');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barbeiro  $barbeiro
     * @return \Illuminate\Http\Response
     */
    public function show(Barbeiro $barbeiro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barbeiro  $barbeiro
     * @return \Illuminate\Http\Response
     */
    public function edit(Barbeiro $barbeiro)
    {
        $data['especialidades'] = Especialidade::all();
        $data['barbeiro'] = $barbeiro;
        $data['barbeiroEspecialidades'] = $barbeiro->especialidades()->get()->pluck('id')->toArray();
        return view('telas.barbeiros.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barbeiro  $barbeiro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barbeiro $barbeiro)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255', 'unique:barbeiros,nome,' . $barbeiro->id],
            'idade' => ['required', 'int', 'min:18', 'max:100'],
            'data_contratacao' => ['required', 'date'],
        ]);
        $barbeiro->nome = $request->nome;
        $barbeiro->idade = $request->idade;
        $barbeiro->data_contratacao = $request->data_contratacao;
        $barbeiro->save();
        $barbeiro->especialidades()->sync($request->especialidades);
        return redirect('barbeiros');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barbeiro  $barbeiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barbeiro $barbeiro)
    {
        $barbeiro->delete();
        return redirect('barbeiros');
    }
}
