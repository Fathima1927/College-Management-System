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
    Schema::create('fee_receipts', function (Blueprint $table) {
        $table->id();

        $table->string('receipt_number')->unique();

        $table->string('student_name');

        $table->string('fee_name');

        $table->decimal('amount', 10, 2);

        $table->date('payment_date');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_receipts');
    }
};
