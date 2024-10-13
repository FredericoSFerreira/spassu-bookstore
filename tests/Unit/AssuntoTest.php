<?php

namespace Tests\Unit;

use App\Models\Assunto;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class AssuntoTest extends TestCase
{
    public function testLivrosRelationship()
    {
        $assunto = new Assunto();

        $this->assertInstanceOf(BelongsToMany::class, $assunto->livros());
        $this->assertInstanceOf(Livro::class, $assunto->livros()->getRelated());
    }

    public function testCreateNewAssunto()
    {
        $assunto = Assunto::create(['descricao' => 'Ciência']);
        $this->assertEquals('Ciência', $assunto->descricao);
    }

    public function testDescricaoIsRequired()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        Assunto::create([]);
    }


}
