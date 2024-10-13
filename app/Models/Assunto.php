<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assunto extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table= 'assunto';
    protected $fillable = ['descricao'];

    public function livros():BelongsToMany
    {
        return $this->belongsToMany(Livro::class, 'livro_assunto');
    }
}
