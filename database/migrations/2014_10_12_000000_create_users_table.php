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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('admission_number')->unique();
            $table->string('image')->nullable();
            $table->string('student_name');
            $table->date('date_of_birth');
            $table->string('aadhar_no')->unique();
            $table->string('nationality');
            $table->string('religion');
            $table->string('gender');
            $table->string('caste');
            $table->text('address');
            $table->string('pin_code');
            $table->string('mother_tongue');
            $table->string('blood_group');
            $table->string('stream')->nullable();
            $table->string('combination_text')->nullable();
            $table->text('school_name')->nullable();
            $table->text('academic_session')->nullable();
            $table->text('class')->nullable();
            $table->text('second_language')->nullable();
            $table->text('achievements')->nullable();
            $table->text('previous_school_info')->nullable();
            $table->string('parent_name');
            $table->string('parent_relation');
            $table->string('qualification');
            $table->string('occupation');
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->string('mobile_no');
            $table->string('parent_aadhar_number')->nullable();
            $table->decimal('annual_income', 10, 2)->nullable();
            $table->string('office_contact_number')->nullable();
            $table->string('mention_relationship')->nullable();
            $table->string('transport_facility')->nullable();
            $table->string('route')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(1)->comment('1=approved, 0=pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};