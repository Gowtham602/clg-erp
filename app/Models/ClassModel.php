<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'classes';

 protected $fillable = ['name', 'section', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function subjects()
{
    return $this->hasMany(Subject::class, 'class_id');
}
}
