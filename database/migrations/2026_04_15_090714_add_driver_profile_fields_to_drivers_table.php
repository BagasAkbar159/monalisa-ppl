<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('license_type', 20)->nullable()->after('license_number');
            $table->date('license_expiry_date')->nullable()->after('license_type');
            $table->text('address')->nullable()->after('license_expiry_date');
            $table->string('status', 50)->default('available')->after('address');
            $table->text('notes')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn([
                'license_type',
                'license_expiry_date',
                'address',
                'status',
                'notes',
            ]);
        });
    }
};