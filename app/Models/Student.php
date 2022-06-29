<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'student_name',
        'father_name',
        'mother_name',
        'student_class',
        'student_address',
        'mob_number'
    ];
}
