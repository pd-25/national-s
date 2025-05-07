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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('user_id');
            $table->string('apply_to_all', 15)->nullable();
            $table->decimal('admission_charges', 10,2)->nullable(); 
            $table->text('admission_charges_months_validation')->nullable();
            $table->decimal('enrolment_fee', 10,2)->nullable(); 
            $table->text('enrolment_fee_months_validation')->nullable();
            $table->decimal('tuition_fee', 10,2)->nullable(); 
            $table->text('tuition_fee_months_validation')->nullable();
            $table->decimal('terminal_fee', 10,2)->nullable(); 
            $table->text('terminal_fee_months_validation')->nullable();
            $table->decimal('sports', 10,2)->nullable();
            $table->text('sports_months_validation')->nullable();
            $table->decimal('misc_charges', 10,2)->nullable();
            $table->text('misc_charges_months_validation')->nullable();
            $table->decimal('scholarship_concession', 10,2)->nullable();
            $table->text('scholarship_concession_validation')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};