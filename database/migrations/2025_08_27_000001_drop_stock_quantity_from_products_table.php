<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Supprimer les index qui pourraient référencer stock_quantity
            // L'index composite ['is_active', 'stock_quantity'] a été créé dans la migration initiale
            try {
                $table->dropIndex(['is_active', 'stock_quantity']);
            } catch (Throwable $e) {
                // Ignorer si l'index n'existe pas (en fonction du nom généré par le SGBD)
            }

            if (Schema::hasColumn('products', 'stock_quantity')) {
                $table->dropColumn('stock_quantity');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Restaurer la colonne avec une valeur par défaut 0
            $table->integer('stock_quantity')->default(0)->after('gallery');
            // Restaurer l'index composite si besoin
            $table->index(['is_active', 'stock_quantity']);
        });
    }
};
