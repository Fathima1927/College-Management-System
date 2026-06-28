<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('college_name')->default('CollegeOS');
            $table->string('college_logo')->nullable();
            $table->text('college_address')->nullable();
            $table->string('college_phone')->nullable();
            $table->string('college_email')->nullable();
            $table->text('report_header')->nullable();
            $table->text('report_footer')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};