<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('village_id')->nullable()->after('company_name')->constrained('villages')->nullOnDelete();
            $table->text('detail_address')->nullable()->after('village_id');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('village_id');
            $table->dropColumn('detail_address');
        });
    }
};