<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('classes', function (Blueprint $table) {

            $table->unsignedBigInteger('department_id')
                ->nullable()
                ->after('id');

            $table->integer('duration_years')
                ->default(4)
                ->after('name');

            $table->integer('total_semesters')
                ->default(8)
                ->after('duration_years');

            $table->boolean('status')
                ->default(1)
                ->after('total_semesters');
        });
    }

    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {

            $table->dropColumn([
                'department_id',
                'duration_years',
                'total_semesters',
                'status'
            ]);
        });
    }
};