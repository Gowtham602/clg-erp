<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'academic_year_id',
        'class_id',
        'semester_id',
        'exam_type',
        'start_date',
        'end_date',
        'status'
    ];
}
