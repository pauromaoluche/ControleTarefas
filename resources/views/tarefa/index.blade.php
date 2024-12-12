@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Tarefas
                            </div>
                            <div class="col-6">
                                <a href="{{ route('tarefa.create') }}" class="me-5">Novo</a>
                                <a href="{{ route('tarefa-export', ['extensao' => 'xlsx']) }}" class="me-5">XLSX</a>
                                <a href="{{ route('tarefa-export', ['extensao' => 'csv']) }}" class="me-5">CSV</a>
                                <a href="{{ route('tarefa-export', ['extensao' => 'pdf']) }}" class="me-5">PDF</a>
                            </div>
                        </div>
                        </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tarefa</th>
                                    <th scope="col">Data limite conclusao</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarefas as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->tarefa }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item->data_limite_conclusao)) }}</td>
                                        <td><a href="{{ route('tarefa.edit', $item->id) }}">Editar</a></td>
                                        <td>
                                            <form id="form_{{ $item->id }}" method="POST" action="{{ route('tarefa.destroy', $item->id) }}" >
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="#" onclick="document.getElementById('form_{{ $item->id }}').submit()">Excluir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $tarefas->previousPageUrl() }}">Voltar</a></li>
                                @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                                    <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $tarefas->url($i) }}"> {{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Avançar</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
