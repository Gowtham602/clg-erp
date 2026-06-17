<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAcademic extends Model
{
    protected $fillable = [
        'student_id',
        'section_id',
        'course_id',
        'semester_id',
        'section_id',
        'academic_year_id',
        'roll_no',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


public function section()
{
    return $this->belongsTo(Section::class, 'section_id');
}
public function course()
{
    return $this->belongsTo(
        ClassModel::class,
        'course_id'
    );
}

public function semester()
{
    return $this->belongsTo(
        Semester::class,
        'semester_id'
    );
}

public function academicYear()
{
    return $this->belongsTo(
        AcademicYear::class,
        'academic_year_id'
    );
}
}