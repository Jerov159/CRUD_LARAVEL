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
        //
        Schema::table('posts', function (Blueprint $table) {
            $table->string('codigo_barras', 50)->nullable()->unique()->after('id');
            $table->string('lote', 50)->nullable()->after('Descripcion_Producto');
            $table->date('fecha_vencimiento')->nullable()->after('lote');
            $table->integer('stock_minimo')->default(10)->after('Cantidad');
            $table->string('ubicacion', 100)->nullable()->after('stock_minimo');
            $table->string('proveedor', 150)->nullable()->after('ubicacion');
            $table->boolean('requiere_receta')->default(false)->after('Estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'codigo_barras',
                'lote',
                'fecha_vencimiento',
                'stock_minimo',
                'ubicacion',
                'proveedor',
                'requiere_receta'
            ]);
        });
    }
};
