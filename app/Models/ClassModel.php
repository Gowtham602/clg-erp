<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [

        'department_id',

        'name',

        'duration_years',

        'total_semesters',

        'status'
    ];

    // Course belongs to Department
    public function department()
    {
        return $this->belongsTo(
            Department::class,
            'department_id'
        );
    }

    // Course has many Sections
    public function sections()
    {
        return $this->hasMany(
            Section::class,
            'class_id'
        );
    }

    // Course has many Subjects
    public function subjects()
    {
        return $this->hasMany(
            Subject::class,
            'class_id'
        );
    }
}