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
        Schema::create('exam_schedules', function (Blueprint $table) {

    $table->id();

    $table->foreignId('exam_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->foreignId('subject_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->date('exam_date');

    $table->time('start_time');

    $table->time('end_time');

    $table->string('room_no')->nullable();

    $table->string('hall_no')->nullable();

    $table->integer('max_marks')->default(100);

    $table->integer('pass_marks')->default(40);

    $table->text('instructions')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_schedules');
    }
};
