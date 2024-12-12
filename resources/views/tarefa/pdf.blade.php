<h2>Lista de Tarefas</h2>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tarefa</th>
            <th scope="col">Data limite conclusão</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->tarefa }}</td>
                <td>{{ date('d/m/Y', strtotime($item->data_limite_conclusao)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
