<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function student_branch(){
        return $this->belongsTo(StudentBranch::class, 'branch_id', 'id');
    }

    public function school_subject(){
        return $this->belongsTo(SchoolSubject::class, 'subject_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

}
