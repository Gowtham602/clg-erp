<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'course_id',

        'name',

        'semester_no',

        'status'
    ];

    public function course()
    {
        return $this->belongsTo(
            ClassModel::class,
            'course_id'
        );
    }
}