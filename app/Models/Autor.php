<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autor';
    protected $fillable = ['nome'];

    public $timestamps = true;

    public function livros(): BelongsToMany
    {
        return $this->belongsToMany(Livro::class, 'livro_autor');
    }
}
