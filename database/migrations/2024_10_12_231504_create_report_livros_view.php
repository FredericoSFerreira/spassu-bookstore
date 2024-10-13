<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW relatorio_livro_autor_assunto AS
                SELECT
                    a.nome AS autor_nome,
                    l.titulo AS livro_titulo,
                    l.editora,
                    l.edicao,
                    l.ano_publicacao,
                    l.valor,
                    GROUP_CONCAT(asu.descricao SEPARATOR ', ') AS assuntos
                FROM
                    livro_autor la
                JOIN
                    autor a ON la.autor_id = a.id
                JOIN
                    livro l ON la.livro_id = l.id
                LEFT JOIN
                    livro_assunto las ON l.id = las.livro_id
                LEFT JOIN
                    assunto asu ON las.assunto_id = asu.id
                GROUP BY
                    la.livro_id, a.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS relatorio_livro_autor_assunto");
    }
};
