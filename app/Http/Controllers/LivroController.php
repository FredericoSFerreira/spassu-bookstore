<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use App\Models\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $livros = Livro::where('titulo', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(10);
        } else {
            $livros = Livro::orderBy('id', 'desc')->paginate(10);

        }
        return response()->json($livros);
    }

    public function show($id): JsonResponse
    {
        $livro = Livro::find($id);
        return response()->json($livro);
    }

    public function store(LivroRequest $request): JsonResponse
    {
        $livro = Livro::create($request->validated());

        if (isset($request['autores'])) {
            $livro->autores()->sync($request['autores']);
        }

        if (isset($request['assuntos'])) {
            $livro->assuntos()->sync($request['assuntos']);
        }

        return response()->json($livro, 201);
    }


    public function update(LivroRequest $request, $id): JsonResponse
    {
        if (Livro::where('id', $id)->exists()) {
            $livro = Livro::find($id);
            $livro->update($request->validated());

            if (isset($request['autores'])) {
                $livro->autores()->sync($request['autores']);
            }

            if (isset($request['assuntos'])) {
                $livro->assuntos()->sync($request['assuntos']);
            }

            return response()->json($request, 200);
        } else {
            return response()->json(['error_code' => 404, 'error_message' => 'Livro não encontrado.'], 404);
        }
    }

    public function destroy($id): JsonResponse
    {
        if (Livro::where('id', $id)->exists()) {
            $livro = Livro::find($id);
            $livro->delete();
            return response()->json();
        } else {
            return response()->json(['error_code' => 404, 'error_message' => 'Livro não encontrado.'], 404);
        }
    }


    public function report(Request $request)
    {
        $relatorio = View::query()
            ->select("*")
            ->get()
            ->toArray();

        $newRelatorio = [];
        if (count($relatorio) > 0) {
            foreach ($relatorio as $key => $value) {
                $newRelatorio[$value['autor_nome']][] = $value;
            }
        }

        $pdf = pdf::loadView('report', [
            'relatorio' => $newRelatorio,
        ]);

        return $pdf->download('Relatorio.pdf');
    }

    public function dashboard(): JsonResponse
    {
        $livros = Livro::count();
        $autores = Autor::count();
        $assuntos = Assunto::count();


        $livrosMaisCaros = DB::table('livro')
            ->select(["titulo", "valor"])
            ->orderBy('valor', 'DESC')
            ->limit(5)
            ->get();

        $consulta = 'Select count(livro.id) as qtd, a.nome from livro
         inner join spassu_books.livro_autor la on livro.id = la.livro_id
         inner join spassu_books.autor a on la.autor_id = a.id
         group by a.nome order by count(livro_id) desc limit 5';

        $autoresMaisLivros = DB::select($consulta);

        return response()->json(['livros' => $livros, 'autores' => $autores, 'assunto' => $assuntos, 'livros_mais_caros' => $livrosMaisCaros,
            'autores_mais_livros' => $autoresMaisLivros]);
    }

}
