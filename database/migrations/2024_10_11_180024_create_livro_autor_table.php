<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livro_autor', function (Blueprint $table) {
            $table->foreignId('livro_id')
                ->constrained('livro')
                ->onDelete('CASCADE');

            $table->foreignId('autor_id')
                ->constrained('autor')
                ->onDelete('CASCADE');

            $table->unique(['livro_id', 'autor_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_autor');
    }
};
