<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHistory extends Model
{
    protected $fillable = [

        'student_id',

        'from_academic_year_id',
        'to_academic_year_id',

        'from_course_id',
        'to_course_id',

        'from_semester_id',
        'to_semester_id',

        'from_section_id',
        'to_section_id',

        'promoted_date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromCourse()
    {
        return $this->belongsTo(
            ClassModel::class,
            'from_course_id'
        );
    }

    public function toCourse()
    {
        return $this->belongsTo(
            ClassModel::class,
            'to_course_id'
        );
    }

    public function fromSemester()
    {
        return $this->belongsTo(
            Semester::class,
            'from_semester_id'
        );
    }

    public function toSemester()
    {
        return $this->belongsTo(
            Semester::class,
            'to_semester_id'
        );
    }

    public function fromSection()
    {
        return $this->belongsTo(
            Section::class,
            'from_section_id'
        );
    }

    public function toSection()
    {
        return $this->belongsTo(
            Section::class,
            'to_section_id'
        );
    }
}