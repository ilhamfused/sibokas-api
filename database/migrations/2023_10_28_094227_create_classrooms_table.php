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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('name_alias')->nullable();
            $table->integer('status')->comment('1:Free, 2:In Use')->default(1);
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('pic_room_id');
            $table->unsignedBigInteger('building_id');
            $table->timestamps();

            $table->foreign('pic_room_id')->references('id')->on('pic_rooms')->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
