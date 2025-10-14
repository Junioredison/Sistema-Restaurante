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
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string(column:'nombre');
            $table->string(column:'apellido');
            $table->string(column:'dni')->unique();
            $table->string(column:'telefono');
            $table->string(column:'direccion');
            $table->string(column:'email')->unique();
            $table->date(column:'fecha_nacimiento');
            $table->string(column:'cargo');
            $table->decimal(column:'salario', total: 8, places: 2);
            $table->date(column:'fecha_contratacion');
            $table->boolean(column:'estado'); // activo o inactivo
            $table->softDeletes(); 
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadors');
    }
};
