<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->string('gcash_receipt_path')->nullable()->after('remarks');
            $table->string('gcash_reference_number')->nullable()->after('gcash_receipt_path');
            $table->timestamp('receipt_uploaded_at')->nullable()->after('gcash_reference_number');
        });
    }

    public function down(): void
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->dropColumn([
                'gcash_receipt_path',
                'gcash_reference_number',
                'receipt_uploaded_at'
            ]);
        });
    }
};