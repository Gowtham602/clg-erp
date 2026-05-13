<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | DROP FOREIGN KEY
            |--------------------------------------------------------------------------
            */

            $table->dropForeign(['section_id']);

            /*
            |--------------------------------------------------------------------------
            | DROP COLUMNS
            |--------------------------------------------------------------------------
            */

            $table->dropColumn([

                'section_id',
                'roll_no',
                'status'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {

            $table->unsignedBigInteger('section_id')->nullable();

            $table->string('roll_no')->nullable();

            $table->string('status')->nullable();

            $table->foreign('section_id')
                  ->references('id')
                  ->on('sections')
                  ->onDelete('cascade');
        });
    }
};