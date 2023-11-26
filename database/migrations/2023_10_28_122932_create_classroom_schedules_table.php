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
        Schema::create('classroom_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('day_of_week')->comment('1:Senin, 2:Selasa, 3:Rabu, 4:Kamis, 5:Jum\'at');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('classroom_id');
            $table->timestamps();

            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            // $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_schedules');
    }
};
