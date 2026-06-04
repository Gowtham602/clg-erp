<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'name',

        'code',

        'status'
    ];

    public function courses()
    {
        return $this->hasMany(
            ClassModel::class,
            'department_id'
        );
    }
}