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
        Schema::create('teacher_class_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id'); 

            $table->foreign('teacher_id')->references('id')->on('admins');
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
        Schema::dropIfExists('teacher_class_mappings');
    }
};