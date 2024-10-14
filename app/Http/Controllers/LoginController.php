<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {

        $email = $request['email'];
        $password = $request['password'];

        if ($email == 'admin@teste.com.br' && $password == '123456') {
            return response()->json(['nome'=> 'Frederico Ferreira', 'email' => $email], 200);

        }
        return response()->json(['error_code' => 401, 'error_message' => 'Email ou senha inválidos.Por Favor tente novamente.'], 401);

    }
}
