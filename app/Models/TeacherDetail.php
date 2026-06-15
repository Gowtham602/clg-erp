<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [

    'user_id',
    'employee_id',
    'department_id',
    'designation_id',
    'employment_type',

    'phone',
    'alternate_phone',
    'email',

    'gender',
    'dob',
    'blood_group',

    'qualification',
    'highest_degree',
    'specialization',
    'university',

    'experience',
    'industry_experience',
    'previous_college',

    'joining_date',
    'salary',

    'aadhaar_no',
    'pan_no',

    'bank_name',
    'account_no',
    'ifsc_code',

    'emergency_contact_name',
    'emergency_contact_phone',
    'relationship',

    'address',
    'city',
    'state',
    'pincode',

    'photo',
    'resume',

    'biometric_id',
    'rfid_no',

    'status'
];

   public function user()
{
    return $this->belongsTo(User::class);
}

public function department()
{
    return $this->belongsTo(
        Department::class
    );
}

public function designation()
{
    return $this->belongsTo(
        Designation::class
    );
}
}