<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('company_name')->constrained('cities')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->after('city_id')->constrained('districts')->nullOnDelete();
            $table->string('village_name')->nullable()->after('district_id');
            $table->text('detail_address')->nullable()->after('village_name');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('city_id');
            $table->dropConstrainedForeignId('district_id');
            $table->dropColumn(['village_name', 'detail_address']);
        });
    }
};