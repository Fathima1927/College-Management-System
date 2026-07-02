<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // --- Step 1: add the new column, only if it doesn't already exist ---
        if (!Schema::hasColumn('fee_payments', 'fee_master_id')) {
            Schema::table('fee_payments', function (Blueprint $table) {
                $table->foreignId('fee_master_id')
                    ->nullable()
                    ->after('student_id')
                    ->constrained('fee_masters')
                    ->nullOnDelete();
            });
        }

        // --- Step 2: best-effort backfill of fee_master_id from fee_name ---
        // Only run this if fee_name still exists (it gets dropped in step 4)
        if (Schema::hasColumn('fee_payments', 'fee_name')) {
            $rows = DB::table('fee_payments')->select('id', 'fee_name')->get();

            foreach ($rows as $row) {
                $match = DB::table('fee_masters')
                    ->where('fee_name', $row->fee_name)
                    ->first();

                if ($match) {
                    DB::table('fee_payments')
                        ->where('id', $row->id)
                        ->update(['fee_master_id' => $match->id]);
                }
            }
        }

        // --- Step 3: rename amount -> amount_paid, only if not already done ---
        if (Schema::hasColumn('fee_payments', 'amount') && !Schema::hasColumn('fee_payments', 'amount_paid')) {
            Schema::table('fee_payments', function (Blueprint $table) {
                $table->renameColumn('amount', 'amount_paid');
            });
        }

        // --- Step 4: drop columns we no longer store, only if they still exist ---
        Schema::table('fee_payments', function (Blueprint $table) {
            foreach (['status', 'student_name', 'fee_name'] as $col) {
                if (Schema::hasColumn('fee_payments', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('fee_payments', function (Blueprint $table) {
            $table->string('student_name')->nullable();
            $table->string('fee_name')->nullable();
            $table->enum('status', ['Paid', 'Pending'])->nullable();
        });

        Schema::table('fee_payments', function (Blueprint $table) {
            $table->renameColumn('amount_paid', 'amount');
        });

        Schema::table('fee_payments', function (Blueprint $table) {
            $table->dropForeign(['fee_master_id']);
            $table->dropColumn(['fee_master_id']);
        });
    }
};