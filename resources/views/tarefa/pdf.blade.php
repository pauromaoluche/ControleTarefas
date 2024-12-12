<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .titulo{
            border: 1px;
            background-color: gray;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 25px;
        }


        table th{
            text-align: left;
        }
    </style>
</head>

<body>
    <h2 class="titulo">Lista de Tarefas</h2>
    <table class="table" style="width: 100%">
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
</body>

</html>
