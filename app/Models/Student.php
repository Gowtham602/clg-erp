<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
   use SoftDeletes;
class Student extends Model
{
    use HasFactory;


    protected $fillable = [

        'admission_no',
        'admission_date',

        'first_name',
        'last_name',
        'dob',
        'gender',
        'blood_group',
        'photo',

        'father_name',
        'mother_name',
        'guardian_phone',

        'phone',
        'email',
        'address',

        'religion',
        'nationality',
        'aadhaar_no',
        'transport_route',

        'created_by',
        'updated_by'
    ];
      public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function academic()
{
    return $this->hasOne(
        StudentAcademic::class,
        'student_id',
        'id'
    );
}

    // Relation: Student → Class
    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

     // Created By
    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
    
    // Who updated
     // Updated By
    public function updater()
    {
        return $this->belongsTo(
            User::class,
            'updated_by'
        );
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    // Promotion History
    public function histories()
    {
        return $this->hasMany(
            StudentHistory::class,
            'student_id'
        );
    }
   public function section()
    {
        return $this->hasOneThrough(
            Section::class,
            StudentAcademic::class,
            'student_id',
            'id',
            'id',
            'section_id'
        );
    }
      // Student Academics
    public function academics()
    {
        return $this->hasMany(
            StudentAcademic::class,
            'student_id'
        );
    }
    
    // Current Academic Record
    public function currentAcademic()
    {
        return $this->hasOne(
            StudentAcademic::class,
            'student_id'
        )->latestOfMany();
    }
}
