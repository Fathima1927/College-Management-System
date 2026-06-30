<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->unique();
            $table->string('employee_name');
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->string('designation');
            $table->enum('category', ['Faculty', 'Staff', 'Non-Teaching Staff']);
            $table->string('pf_no')->nullable();
            $table->string('esi_no')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};