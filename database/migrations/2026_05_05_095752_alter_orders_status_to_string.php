<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE orders ALTER COLUMN status TYPE VARCHAR(50)");
        DB::statement("ALTER TABLE orders ALTER COLUMN status SET DEFAULT 'masuk'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE orders ALTER COLUMN status TYPE VARCHAR(20)");
        DB::statement("ALTER TABLE orders ALTER COLUMN status SET DEFAULT 'masuk'");
    }
};