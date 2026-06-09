<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_histories', function (Blueprint $table) {

            $table->dropColumn('academic_year');

            $table->foreignId('from_academic_year_id')
                ->nullable()
                ->after('student_id');

            $table->foreignId('to_academic_year_id')
                ->nullable()
                ->after('from_academic_year_id');

            $table->foreignId('from_course_id')
                ->nullable()
                ->after('to_academic_year_id');

            $table->foreignId('to_course_id')
                ->nullable()
                ->after('from_course_id');

            $table->foreignId('from_semester_id')
                ->nullable()
                ->after('to_course_id');

            $table->foreignId('to_semester_id')
                ->nullable()
                ->after('from_semester_id');

            $table->date('promoted_date')
                ->nullable()
                ->after('to_section_id');
        });
    }

    public function down(): void
    {
        Schema::table('student_histories', function (Blueprint $table) {

            $table->string('academic_year')->nullable();

            $table->dropColumn([

                'from_academic_year_id',
                'to_academic_year_id',

                'from_course_id',
                'to_course_id',

                'from_semester_id',
                'to_semester_id',

                'promoted_date'
            ]);
        });
    }
};