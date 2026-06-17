<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    protected $fillable = [

        'exam_id',
        'subject_id',

        'exam_date',

        'start_time',
        'end_time',

        'room_no',
        'hall_no',

        'max_marks',
        'pass_marks',

        'instructions'
    ];

    public function exam()
    {
        return $this->belongsTo(
            Exams::class
        );
    }

    public function subject()
    {
        return $this->belongsTo(
            Subject::class
        );
    }
}