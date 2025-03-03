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
        Schema::create('admission_notices', function (Blueprint $table) {
            $table->id();
            $table->string('admi_notice_name');
            $table->timestamp('admi_notice_date');
            $table->string('image')->nullable();
            $table->boolean('status')->default(1)->comment('1=approved, 0=pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_notices');
    }
};