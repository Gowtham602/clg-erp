<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_academics', function (Blueprint $table) {

            $table->foreignId('academic_year_id')
                ->after('student_id')
                ->nullable();

            $table->foreignId('course_id')
                ->after('academic_year_id')
                ->nullable();

            $table->foreignId('semester_id')
                ->after('course_id')
                ->nullable();

            $table->dropColumn('academic_year');
        });
    }

    public function down(): void
    {
        Schema::table('student_academics', function (Blueprint $table) {

            $table->string('academic_year')->nullable();

            $table->dropColumn([
                'academic_year_id',
                'course_id',
                'semester_id'
            ]);
        });
    }
};