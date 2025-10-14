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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal(column:'total', total: 8, places: 2);
            $table->string(column:'estado'); // pendiente, en proceso, completado, cancelado
            $table->foreignId(column: 'mesa_id')->constrained(table: 'mesas')->onDelete(action: 'cascade');
            $table->foreignId(column: 'trabajador_id')->constrained(table: 'trabajadors')->onDelete(action: 'cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
