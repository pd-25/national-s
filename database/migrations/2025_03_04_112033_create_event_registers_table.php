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
        Schema::create('event_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('email');
            $table->string('name');
            $table->timestamp('date');
            $table->string('school_name');
            $table->string('class');
            $table->string('father_name');
            $table->string('contact_number');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('contact_number_ii')->nullable();
            $table->boolean('status')->default(1)->comment('1=approved, 0=pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registers');
    }
};