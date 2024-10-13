<?php

namespace Tests\Unit;

use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class AutorTest extends TestCase
{
    public function testLivrosRelationship()
    {
        $autor = new Autor();
        $this->assertInstanceOf(BelongsToMany::class, $autor->livros());
        $this->assertInstanceOf(Livro::class, $autor->livros()->getRelated());
    }

    public function testCreateNewAutor()
    {
        $autor = Autor::create(['nome' => 'Autor Exemplo']);
        $this->assertEquals('Autor Exemplo', $autor->nome);
    }

    public function testNomeIsRequired()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        Autor::create([]);
    }
}
