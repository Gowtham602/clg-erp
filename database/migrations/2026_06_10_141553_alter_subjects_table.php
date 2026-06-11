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
            Schema::table('subjects', function (Blueprint $table) {

    $table->foreignId('semester_id')
          ->nullable()
          ->after('class_id')
          ->constrained('semesters');

    $table->string('subject_code')->nullable();

    $table->enum('subject_type', [
        'Theory',
        'Lab'
    ])->default('Theory');

    $table->integer('credits')->default(0);

    $table->integer('max_marks')->default(100);

    $table->integer('pass_marks')->default(40);

    $table->boolean('status')->default(1);

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
