<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMarks extends Model
{
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
    
    public function student_branch(){
        return $this->belongsTo(StudentBranch::class, 'branch_id', 'id');
    }

    public function student_group(){
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }

    public function student_year(){
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function assign_subject(){
        return $this->belongsTo(AssignSubject::class, 'assign_subject_id', 'id');
    }

    public function exam_type(){
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }
    public function season(){
        return $this->belongsTo(SchoolSeason::class, 'season_id', 'id');
    }
}
