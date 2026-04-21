<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chicken_productions', function (Blueprint $table) {
            $table->id();
            $table->date('production_date');
            $table->integer('quantity_chicken');
            $table->decimal('total_weight_kg', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chicken_productions');
    }
};