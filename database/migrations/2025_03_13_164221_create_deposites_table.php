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
        Schema::create('deposites', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->uniqid();
            $table->unsignedBigInteger('user_id');
            $table->string('student_name')->nullable();
            $table->string('student_roll')->nullable();
            $table->string('parents_name')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile_no')->nullable();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id'); 
            $table->string('month'); 
            $table->string('year'); 
            $table->decimal('enrolment_fee', 10,2)->nullable(); 
            $table->decimal('tuition_fee', 10,2)->nullable(); 
            $table->decimal('terminal_fee', 10,2)->nullable(); 
            $table->decimal('misc_charges', 10,2)->nullable(); 
            $table->decimal('identity_card', 10,2)->nullable(); 
            $table->decimal('total', 18,2); 
            $table->string('payment_mode', 30);
            $table->string('transaction_id')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('cheque_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('payment_ref_no')->uniqid()->nullable();
            $table->string('payment_getway_id')->uniqid()->nullable();
            $table->string('status')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposites');
    }
};