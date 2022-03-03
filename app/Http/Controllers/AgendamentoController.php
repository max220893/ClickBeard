<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Barbeiro;
use App\Models\Especialidade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();

        $data['agendamentos'] = [];

        if ($usuario->admin) {
            $data['agendamentos'] = Agendamento::All();
        } else {
            $data['agendamentos'] = Agendamento::where('usuario_id', $usuario->id)->get();
        }

        return view('dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horarios = [];
        $tempo = "7:30";
        while ($tempo != "17:30") {
            $tempo = date("H:i", strtotime('+30 minutes', strtotime($tempo)));
            $horarios[] = $tempo;
        }

        $data['horarios'] = $horarios;

        $data['especialidades'] = Especialidade::all();

        return view('telas.agendamento.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data . ' ' . $request->horario;
        $data = date("Y-m-d H:i", (strtotime($data)));

        $agendamento = Agendamento::where('data', $data)->where('barbeiro_id', $request->barbeiro)->get();

        throw_if(!$request->barbeiro, 'Barbeiro não selecionado');
        throw_if(count($agendamento) > 0, 'Barbeiro ocupado nesse horário.');

        $dados = [];

        $dados['data'] = $data;
        $dados['usuario_id'] = Auth::user()->id;
        $dados['especialidade_id'] = $request->especialidade;
        $dados['barbeiro_id'] = $request->barbeiro;

        Agendamento::create($dados);

        return view('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show(Agendamento $agendamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {
        $dataAtual = date('Y-m-d H:i:s');
        $diferencaHoras = round((strtotime($agendamento->data) - strtotime($dataAtual)) / 3600, 1);

        if ($diferencaHoras > 2) {
            $agendamento->delete();
            return redirect('dashboard');
        } else {
            throw new Exception("O agendamento não foi cancelado porque faltam menos que duas horas para a realização do serviço agendado.", 403);
        }
    }

    public function barbeiroDisponivel(Request $request)
    {
        $data = $request->data . ' ' . $request->horario;
        $especialidadeId = $request->especialidade;

        $especialidade = Especialidade::findOrFail($especialidadeId);


        $data = date("Y-m-d H:i", (strtotime($data)));

        $agendamento = Agendamento::where('data', $data)->get()->pluck('barbeiro_id')->toArray();

        $barbeiros = $especialidade->barbeiros()->whereNotIn('id', $agendamento)->get();

        return response()->json($barbeiros);
    }
}
