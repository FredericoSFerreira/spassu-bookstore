<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssuntoRequest;
use App\Models\Assunto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    public function index(Request $request): JsonResponse
    {

        $search = $request->query('search');
        $paginate = $request->query('paginate');

        if (!isset($paginate)) {
            $paginate = 10;
        }

        if (!empty($search)) {
            $assuntos= Assunto::where('descricao', 'like', '%'.$search.'%')->orderBy('id', 'desc')->paginate($paginate);
        } else {
            $assuntos= Assunto::orderBy('id', 'desc')->paginate($paginate);

        }
        return response()->json($assuntos);
    }

    public function show($id): JsonResponse
    {
        $assunto = Assunto::find($id);
        return response()->json($assunto);
    }

    public function store(AssuntoRequest $request): JsonResponse
    {
        $assunto = Assunto::create([
            'descricao' => $request->descricao
        ]);
        return response()->json($assunto, 201);
    }


    public function update(AssuntoRequest $request, $id): JsonResponse
    {
        if (Assunto::where('id', $id)->exists()) {
            $assunto = Assunto::find($id);
            $assunto->descricao = $request->descricao;
            $assunto->save();
            return response()->json($request, 200);
        } else {
            return response()->json(['error_code'=> 404, 'error_message'=>'Assunto não encontrado.'], 404);
        }
    }

    public function destroy($id): JsonResponse
    {
        if (Assunto::where('id', $id)->exists()) {
            $assunto = Assunto::find($id);
            $assunto->delete();
            return response()->json();
        } else {
            return response()->json(['error_code'=> 404, 'error_message'=>'Assunto não encontrado.'], 404);
        }
    }
}
