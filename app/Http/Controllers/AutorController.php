<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorRequest;
use App\Models\Autor;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(Request $request): JsonResponse
    {

        $search = $request->query('search');
        $paginate = $request->query('paginate');

        if (!isset($paginate)) {
            $paginate = 10;
        }

        if (!empty($search)) {
            $autores = Autor::where('nome', 'like', '%'.$search.'%')->orderBy('id', 'desc')->paginate($paginate);
        } else {
            $autores = Autor::orderBy('id', 'desc')->paginate($paginate);

        }
        return response()->json($autores);
    }

    public function show($id): JsonResponse
    {
        $autor = Autor::find($id);
        return response()->json($autor);
    }

    public function store(AutorRequest $request): JsonResponse
    {
        $autor = Autor::create([
            'nome' => $request->nome
        ]);
        return response()->json($autor, 201);
    }


    public function update(AutorRequest $request, $id): JsonResponse
    {
        if (Autor::where('id', $id)->exists()) {
            $autor = Autor::find($id);
            $autor->nome = $request->nome;
            $autor->save();
            return response()->json($request, 200);
        } else {
            return response()->json(['error_code'=> 404, 'error_message'=>'Autor não encontrado.'], 404);
        }
    }

    public function destroy($id): JsonResponse
    {
        if (Autor::where('id', $id)->exists()) {
            $autor = Autor::find($id);
            $autor->delete();
            return response()->json();
        } else {
            return response()->json(['error_code'=> 404, 'error_message'=>'Autor não encontrado.'], 404);
        }
    }


}
