<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('product_type')->default('sound-tag')->after('category'); // sound-tag, pack
            $table->integer('pack_size')->nullable()->after('product_type'); // 3, 6, 10
            $table->json('selected_tags')->nullable()->after('pack_size'); // IDs des tags sélectionnés pour un pack
            $table->boolean('is_configurable')->default(false)->after('selected_tags'); // Si le pack est configurable
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['product_type', 'pack_size', 'selected_tags', 'is_configurable']);
        });
    }
};
