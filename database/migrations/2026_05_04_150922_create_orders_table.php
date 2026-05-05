<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();

            $table->string('order_code')->unique();
            $table->date('order_date');

            $table->integer('quantity_chicken');
            $table->decimal('estimated_weight_kg', 10, 2);
            $table->decimal('price_per_kg', 12, 2);
            $table->decimal('estimated_total', 14, 2);

            $table->enum('status', ['masuk', 'diproses', 'dikirim', 'selesai'])->default('masuk');

            $table->text('notes')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};