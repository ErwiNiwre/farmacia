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
        Schema::table('compra_detalles', function (Blueprint $table) {
            $table->decimal('precio_unitario', 13, 4)->change();
        });

        Schema::table('kardex', function (Blueprint $table) {
            $table->decimal('precio_unitario', 13, 4)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compra_detalles', function (Blueprint $table) {
            $table->decimal('precio_unitario', 13, 2)->change();
        });

        Schema::table('kardex', function (Blueprint $table) {
            $table->decimal('precio_unitario', 13, 2)->nullable()->change();
        });
    }
};
