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
        // Tabla: unidad_medida
        Schema::create('unidad_medidas', function (Blueprint $table) {
            $table->id();
            $table->string('unidad_medida');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: clasificaciones
        Schema::create('clasificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('clasificacion');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: laboratorio_servicios
        Schema::create('laboratorio_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('servicio');
            $table->decimal('precio', 13, 2);
            $table->foreignId('clasificacion_id')->constrained('clasificaciones')->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: accion_terapeuticas
        Schema::create('accion_terapeuticas', function (Blueprint $table) {
            $table->id();
            $table->string('accion_terapeutica');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: presentaciones
        Schema::create('presentaciones', function (Blueprint $table) {
            $table->id();
            $table->string('presentacion');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: marcas
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: concentraciones
        Schema::create('concentraciones', function (Blueprint $table) {
            $table->id();
            $table->string('concentracion');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: productos
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('tipo_producto', ['M', 'I']);
            $table->string('codigo')->nullable();
            $table->string('barras')->unique();
            $table->enum('codigo_generado', ['S', 'N'])->default('N');
            $table->string('producto');
            $table->string('generico')->nullable();
            $table->foreignId('concentracion_id')->constrained('concentraciones')->restrictOnDelete();
            $table->foreignId('marca_id')->constrained('marcas')->restrictOnDelete();
            $table->foreignId('presentacion_id')->constrained('presentaciones')->restrictOnDelete();
            $table->foreignId('accion_terapeutica_id')->constrained('accion_terapeuticas')->restrictOnDelete();
            $table->foreignId('unidad_medida_id')->constrained('unidad_medidas')->restrictOnDelete();
            $table->enum('estado', ['A', 'M', 'D'])->default('A');
            $table->unsignedInteger('stock_minimo');
            $table->unsignedInteger('cantidad')->default(0);
            // $table->unsignedInteger('total_productos')->default(0);
            // $table->unsignedInteger('entradas')->default(0);
            // $table->unsignedInteger('salidas')->default(0);
            $table->decimal('precio_unitario', 13, 2);
            $table->decimal('porcentaje', 13, 2);
            $table->decimal('precio_venta', 13, 2);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: kardex
        Schema::create('kardex', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos');
            $table->enum('tipo_movimiento', ['E', 'S', 'A']); // Entrada, Salida, Ajuste
            $table->enum('origen', ['Compra', 'Venta', 'Ajuste'])->nullable();
            $table->unsignedInteger('cantidad');
            $table->decimal('precio_unitario', 13, 2)->nullable();
            $table->decimal('subtotal', 13, 2)->nullable();
            $table->string('observacion')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: compras
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('compra_fecha')->nullable();
            $table->bigInteger('numero_compra');
            $table->string('proveedor');
            $table->string('tipo');
            $table->decimal('total', 13, 2)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: compra_detalles
        Schema::create('compra_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras')->cascadeOnDelete();
            $table->foreignId('producto_id')->constrained('productos')->restrictOnDelete();
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 13, 2);
            $table->decimal('subtotal', 13, 2);
            $table->date('vencimiento')->nullable();
            $table->integer('cantidad_total');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: ventas
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('venta_fecha')->nullable();
            $table->bigInteger('numero_venta');
            $table->string('cliente');
            $table->enum('metodo_pago', ['N', 'E', 'Q', 'M'])->default('N');
            $table->decimal('total', 13, 2)->nullable();
            $table->decimal('efectivo', 13, 2)->nullable();
            $table->decimal('qr', 13, 2)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla: venta_detalles
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas')->cascadeOnDelete();
            $table->foreignId('producto_id')->constrained('productos')->restrictOnDelete();
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 13, 2);
            $table->decimal('subtotal', 13, 2);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidad_medidas');
        Schema::dropIfExists('clasificaciones');
        Schema::dropIfExists('laboratorio_servicios');
        Schema::dropIfExists('venta_detalles');
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('compra_detalles');
        Schema::dropIfExists('compras');
        Schema::dropIfExists('kardex');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('concentraciones');
        Schema::dropIfExists('marcas');
        Schema::dropIfExists('presentaciones');
        Schema::dropIfExists('accion_terapeuticas');
    }
};
