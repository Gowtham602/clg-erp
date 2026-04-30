<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

   public function teachers()
{
    return $this->belongsToMany(User::class, 'subject_teacher', 'subject_id', 'teacher_id');
}
}
