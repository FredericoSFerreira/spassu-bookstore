<?php

namespace Tests\Feature;

use App\Models\Assunto;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AssuntoTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_createAssunto()
    {

        $assuntoData = [
            'descricao' => 'Assunto de Teste'
        ];

        $this
            ->postjson('/assuntos', $assuntoData, ['Accept' => 'application/json'])
            ->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson([
                'data' => [
                    'descricao' => 'Assunto de Teste'
                ]
            ]);
    }

    public function test_showAssunto()
    {
        $assunto = new Assunto(['descricao' => 'Assunto Exemplo']);
        $assunto->save();

        $this
            ->getJson('/assuntos/1')
            ->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson([
                'data' => [
                    'descricao' => 'Assunto Exemplo'
                ]
            ]);
    }

    public function test_assuntoNotFound()
    {
        $this
            ->getJson('/assuntos/999999')
            ->assertStatus(ResponseAlias::HTTP_NOT_FOUND);
    }

    public function test_deleteAssunto()
    {
        $assunto = new Assunto(['descricao' => 'Assunto para Deletar']);
        $assunto->save();

        $this
            ->deleteJson('/assuntos/1')
            ->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_deleteAssuntoNotExists()
    {
        $this
            ->deleteJson('/assuntos/999999')
            ->assertStatus(ResponseAlias::HTTP_NOT_FOUND);
    }
}
