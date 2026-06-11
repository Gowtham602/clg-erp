<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectTeacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'academic_year_id',
        'class_id',
        'semester_id',
        'subject_id',
        'section_id',
        'teacher_id',
        'status'
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function classModel()
    {
        return $this->belongsTo(
            ClassModel::class,
            'class_id'
        );
    }

    public function semester()
    {
        return $this->belongsTo(
            Semester::class
        );
    }

    public function subject()
    {
        return $this->belongsTo(
            Subject::class
        );
    }

    public function section()
    {
        return $this->belongsTo(
            Section::class
        );
    }

    public function teacher()
    {
        return $this->belongsTo(
            User::class,
            'teacher_id'
        );
    }
}


