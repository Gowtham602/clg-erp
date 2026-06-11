<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subject_teachers', function (Blueprint $table) {

            $table->foreignId('academic_year_id')
                ->after('id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('class_id')
                ->after('academic_year_id')
                ->nullable()
                ->constrained('classes')
                ->cascadeOnDelete();

            $table->foreignId('semester_id')
                ->after('class_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->boolean('status')
                ->default(1)
                ->after('teacher_id');
        });
    }

    public function down(): void
    {
        Schema::table('subject_teachers', function (Blueprint $table) {

            $table->dropForeign(['academic_year_id']);
            $table->dropForeign(['class_id']);
            $table->dropForeign(['semester_id']);

            $table->dropColumn([
                'academic_year_id',
                'class_id',
                'semester_id',
                'status'
            ]);
        });
    }
};