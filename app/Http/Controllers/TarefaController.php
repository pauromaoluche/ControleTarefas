<?php

namespace App\Http\Controllers;

use App\Exports\tarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tarefas = Tarefa::where('user_id', auth()->user()->id)->paginate(3);

        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);
        $destinatario = auth()->user()->email;
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {

        if (auth()->user()->id !== $tarefa->user_id) {
            return view('acesso-negado');
        }

        return view('tarefa.edit', ['tarefa' => $tarefa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {

        if (auth()->user()->id !== $tarefa->user_id) {
            return view('acesso-negado');
        }

        $tarefa->update($request->all());
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    public function export($extensao = null)
    {

        if (in_array($extensao, ['xlsx', 'csv', 'pdf'])) {
            return Excel::download(new tarefasExport, 'tarefa.'.$extensao );
        }else{

            $data = auth()->user()->tarefas()->get();
            $pdf = Pdf::loadView('tarefa.pdf', ['data' => $data]);
            // return $pdf->download('lista_tarefas.pdf');
            return $pdf->stream('lista_tarefas.pdf');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        if (auth()->user()->id !== $tarefa->user_id) {
            return view('acesso-negado');
        }

        $tarefa->delete();

        return redirect()->route('tarefa.index');
    }
}
