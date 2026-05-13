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
        'roll_no',
        'section_id',
        'admission_date',
        'status',

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

    // Relation: Student → Class
    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    // Who updated
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function histories()
    {
        return $this->hasMany(StudentHistory::class);
    }
     public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function academics()
    {
    return $this->hasMany(StudentAcademic::class);
    }
    
    public function currentAcademic()
    {
        return $this->hasOne(StudentAcademic::class)
            ->latestOfMany();
    }
}
