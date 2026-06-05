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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->string('cep', 9);
            $table->string('logradouro');
            $table->string('numero', 20);
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->text('conteudo');
            $table->string('nome_destinatario');
            $table->string('codigo_pedido');
            $table->foreignId('cidade_id')->constrained('cidades');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('status_entrega_id')->constrained('status_entregas');
            $table->foreignId('motoboy_id')->constrained('motoboys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
