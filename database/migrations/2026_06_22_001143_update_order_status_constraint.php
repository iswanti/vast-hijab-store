<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE orders
            DROP CONSTRAINT IF EXISTS orders_status_check
        ");

        DB::statement("
            ALTER TABLE orders
            ADD CONSTRAINT orders_status_check
            CHECK (
                status IN (
                    'Menunggu Konfirmasi',
                    'Diproses',
                    'Dikirim',
                    'Selesai',
                    'Dibatalkan'
                )
            )
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE orders
            DROP CONSTRAINT IF EXISTS orders_status_check
        ");
    }
};
