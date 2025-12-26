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
        Schema::create('budget_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_year_id')->constrained()->onDelete('cascade');
            $table->foreignId('government_unit_id')->constrained()->onDelete('cascade');
            $table->decimal('total_allocated', 15, 2);
            $table->decimal('total_spent', 15, 2);
            $table->decimal('utilization_rate', 5, 2);
            $table->json('spending_by_category')->nullable();
            $table->timestamps();
            $table->unique(['fiscal_year_id', 'government_unit_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_summaries');
    }
};
