<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teacher_details', function (Blueprint $table) {

            // Professional

            // Professional

$table->foreignId('department_id')
      ->nullable()
      ->after('employee_id')
      ->constrained('departments')
      ->nullOnDelete();

$table->foreignId('designation_id')
      ->nullable()
      ->after('department_id')
      ->constrained('designations')
      ->nullOnDelete();

$table->enum('employment_type', [
    'Full Time',
    'Part Time',
    'Guest'
])->nullable()->after('designation_id');

            // Contact

            $table->string('email')
                  ->nullable()
                  ->after('alternate_phone');

            // Education

            $table->string('highest_degree')
                  ->nullable()
                  ->after('qualification');

            $table->string('specialization')
                  ->nullable()
                  ->after('highest_degree');

            $table->string('university')
                  ->nullable()
                  ->after('specialization');

            // Experience

            $table->integer('industry_experience')
                  ->default(0)
                  ->after('experience');

            $table->string('previous_college')
                  ->nullable()
                  ->after('industry_experience');

            // Documents

            $table->string('pan_no')
                  ->nullable()
                  ->after('aadhaar_no');

            // Bank

            $table->string('bank_name')
                  ->nullable()
                  ->after('pan_no');

            $table->string('account_no')
                  ->nullable()
                  ->after('bank_name');

            $table->string('ifsc_code')
                  ->nullable()
                  ->after('account_no');

            // Emergency

            $table->string('emergency_contact_name')
                  ->nullable()
                  ->after('ifsc_code');

            $table->string('emergency_contact_phone')
                  ->nullable()
                  ->after('emergency_contact_name');

            $table->string('relationship')
                  ->nullable()
                  ->after('emergency_contact_phone');

            // Files

            $table->string('resume')
                  ->nullable()
                  ->after('photo');

            // Attendance

            $table->string('biometric_id')
                  ->nullable()
                  ->after('resume');

            $table->string('rfid_no')
                  ->nullable()
                  ->after('biometric_id');
        });
    }

    public function down(): void
    {
        Schema::table('teacher_details', function (Blueprint $table) {
    $table->dropForeign(['department_id']);
        $table->dropForeign(['designation_id']);
            $table->dropColumn([
                'department_id',
                'designation',
                'employment_type',
                'email',
                'highest_degree',
                'specialization',
                'university',
                'industry_experience',
                'previous_college',
                'pan_no',
                'bank_name',
                'account_no',
                'ifsc_code',
                'emergency_contact_name',
                'emergency_contact_phone',
                'relationship',
                'resume',
                'biometric_id',
                'rfid_no'
            ]);
        });
    }
};