<?php

namespace Tests\Feature;

use App\Models\Assunto;
use App\Models\Livro;
use App\Models\Autor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LivroTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_createLivro()
    {
        $autor = Autor::factory()->create([
            'nome' => $this->faker->text(40)
        ]);
        $assunto = Assunto::factory()->create([
            'descricao' => $this->faker->text(20)
        ]);

        $livroData = [
            'titulo' => 'Livro de Teste',
            'ano_publicacao' => '2020',
            'editora' => 'Editora Teste',
            'edicao' => '1',
            'valor' => 50.00,
            'autores' => [$autor->id],
            'assuntos' => [$assunto->id],
        ];

        $this
            ->postJson('/livros', $livroData, ['Accept' => 'application/json'])
            ->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_showLivro()
    {
        $autor = Autor::factory()->create([
            'nome' => $this->faker->text(40)
        ]);
        $assunto = Assunto::factory()->create([
            'descricao' => $this->faker->text(20)
        ]);

        $livroData = [
            'titulo' => 'Livro de Teste',
            'ano_publicacao' => '2020',
            'editora' => 'Editora Teste',
            'edicao' => '1',
            'valor' => 50.00,
            'autores' => [$autor->id],
            'assuntos' => [$assunto->id],
        ];
        $livro = new Livro($livroData);
        $livro->save();


        $this
            ->getJson('/livros/'. $livro->id)
            ->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson([
                'data' => [
                    'titulo' => 'Livro de Teste',
                    'anoPublicacao' => '2020',
                    'editora' => 'Editora Teste',
                    'edicao' => '1',
                    'valor' => 50.00
                ]
            ]);
    }

    public function test_livroNotFound()
    {
        $this
            ->getJson('/livros/999999')
            ->assertStatus(ResponseAlias::HTTP_NOT_FOUND);
    }

    public function test_deleteLivro()
    {
        $autor = Autor::factory()->create();
        $livro = new Livro([
            'titulo' => 'Livro Exemplo',
            'autor_id' => $autor->id,
            'ano_publicacao' => '2021',
            'editora' => 'Editora Exemplo',
            'edicao' => '1',
            'valor' => 50.00
        ]);
        $livro->save();


        $this
            ->deleteJson('/livros'.$livro->id)
            ->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_deleteLivroNotExists()
    {
        $this
            ->deleteJson('/livros/999999')
            ->assertStatus(ResponseAlias::HTTP_NOT_FOUND);
    }
}
