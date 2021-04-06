<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistemas</title>
    <style>
        .table {
            border-collapse: collapse;
        }

        .table td,
        .table th {
            border-bottom: 1px solid #000000;
            padding: 15px 10px;
        }
    </style>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Versão</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($systems as $system)
                <tr>
                    <td style="width: 30%;">{{ $system->name }}</td>
                    <td style="width: 60%;">{{ $system->description }}</td>
                    <td style="width: 10%; text-align: center;">{{ $system->version }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
