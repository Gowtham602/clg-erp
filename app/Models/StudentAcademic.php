<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAcademic extends Model
{
    protected $fillable = [
        'student_id',
        'section_id',
        'academic_year',
        'roll_no',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}