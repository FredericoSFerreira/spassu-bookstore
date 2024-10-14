<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use \App\Http\Controllers\AutorController;
use \App\Http\Controllers\AssuntoController;
use \App\Http\Controllers\LivroController;
use App\Http\Middleware\JwtMiddleware;


Route::post('login', [LoginController::class, 'login']);

Route::get('autores', [AutorController::class, 'index']);
Route::post('autores', [AutorController::class, 'store']);
Route::get('autores/{id}', [AutorController::class, 'show']);
Route::put('autores/{id}', [AutorController::class, 'update']);
Route::delete('autores/{id}', [AutorController::class, 'destroy']);



Route::get('assuntos', [AssuntoController::class, 'index']);
Route::post('assuntos', [AssuntoController::class, 'store']);
Route::get('assuntos/{id}', [AssuntoController::class, 'show']);
Route::put('assuntos/{id}', [AssuntoController::class, 'update']);
Route::delete('assuntos/{id}', [AssuntoController::class, 'destroy']);



Route::get('livros', [LivroController::class, 'index']);
Route::post('livros', [LivroController::class, 'store']);
Route::get('livros/{id}', [LivroController::class, 'show']);
Route::put('livros/{id}', [LivroController::class, 'update']);
Route::delete('livros/{id}', [LivroController::class, 'destroy']);


Route::get('relatorio', [LivroController::class, 'report']);

Route::get('dashboard', [LivroController::class, 'dashboard']);


