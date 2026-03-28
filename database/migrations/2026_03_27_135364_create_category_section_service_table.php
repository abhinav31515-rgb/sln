<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_section_service', function (Blueprint $table) {
            $table->foreignId('category_section_id')->constrained('category_sections')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->integer('sort_order')->default(0);

            $table->primary(['category_section_id', 'service_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_section_service');
    }
};
