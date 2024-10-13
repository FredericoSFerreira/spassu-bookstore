<?php

namespace Tests\Unit;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class LivroTest extends TestCase
{
    public function testAutoresRelationship()
    {
        $livro = new Livro();
        $this->assertInstanceOf(BelongsToMany::class, $livro->autores());
        $this->assertInstanceOf(Autor::class, $livro->autores()->getRelated());
    }

    public function testAssuntosRelationship()
    {
        $livro = new Livro();
        $this->assertInstanceOf(BelongsToMany::class, $livro->assuntos());
        $this->assertInstanceOf(Assunto::class, $livro->assuntos()->getRelated());
    }

    public function testCreateNewLivro()
    {
        $livro = Livro::create([
            'titulo' => 'Livro de Teste',
            'editora' => 'Editora Teste',
            'edicao' => 1,
            'ano_publicacao' => 2020,
            'valor' => 50.00
        ]);
        $this->assertEquals('Livro de Teste', $livro->titulo);
        $this->assertEquals('Editora Teste', $livro->editora);
    }

    public function testTituloIsRequired()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        Livro::create([
            'editora' => 'Editora Teste',
            'edicao' => 1,
            'ano_publicacao' => 2020,
            'valor' => 50.00
        ]);
    }
}
