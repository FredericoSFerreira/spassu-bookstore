<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Livro extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'livro';
    protected $with = ['autores', 'assuntos'];
    protected $fillable = [
        'titulo',
        'editora',
        'edicao',
        'ano_publicacao',
        'valor'
    ];

    public function autores():BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'livro_autor');
    }

    public function assuntos():BelongsToMany
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto');
    }
}
