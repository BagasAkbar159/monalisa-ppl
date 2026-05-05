<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            if (! Schema::hasColumn('customers', 'city_id')) {
                $table->foreignId('city_id')
                    ->nullable()
                    ->after('company_name')
                    ->constrained('cities')
                    ->nullOnDelete();
            }

            if (! Schema::hasColumn('customers', 'district_id')) {
                $table->foreignId('district_id')
                    ->nullable()
                    ->after('city_id')
                    ->constrained('districts')
                    ->nullOnDelete();
            }

            if (! Schema::hasColumn('customers', 'village_name')) {
                $table->string('village_name')
                    ->nullable()
                    ->after('district_id');
            }

            if (! Schema::hasColumn('customers', 'detail_address')) {
                $table->text('detail_address')
                    ->nullable()
                    ->after('village_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            if (Schema::hasColumn('customers', 'district_id')) {
                $table->dropConstrainedForeignId('district_id');
            }

            if (Schema::hasColumn('customers', 'city_id')) {
                $table->dropConstrainedForeignId('city_id');
            }

            if (Schema::hasColumn('customers', 'village_name')) {
                $table->dropColumn('village_name');
            }

            if (Schema::hasColumn('customers', 'detail_address')) {
                $table->dropColumn('detail_address');
            }
        });
    }
};