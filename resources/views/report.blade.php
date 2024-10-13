
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>
        Relatório geral dos livros
    </title>
</head>
<body>

<div class="divHeader">
    <div class="title">
        <h1>Relatório Geral BookStore</h1>
    </div>

    <div class="date">
        <b>Data:</b> {{ date('d/m/Y') }}
    </div>
</div>
<br />
<hr />

@foreach($relatorio as $autor => $livros)

    <div class="autor">
        <b>Autor:</b> {{ $autor }}<br />
    </div>
    <br>
    <div>
        <table id="customers">
            <thead>
            <tr>
                <th>Título</th>
                <th>Editora</th>
                <th>Edição</th>
                <th>Ano de Publicação</th>
                <th>Valor</th>
                <th>Assuntos</th>
            </tr>
            </thead>

            @foreach($livros as $livro)
                <tr>
                    <td>{{ $livro['livro_titulo'] }}</td>
                    <td>{{ $livro['editora'] }}</td>
                    <td>{{ $livro['edicao'] }}</td>
                    <td>{{ $livro['ano_publicacao'] }}</td>
                    <td>R$ {{ $livro['valor'] }}</td>
                    <td>{{ $livro['assuntos'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <br />

@endforeach

<style>

.title {
    text-align: center;
}
.date {
    font-size: 20px;
}

.autor {
    font-size: 20px;
}
#customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #3a57e8;
    color: white;
}

hr{
    color: #3a57e8;
}
</style>
