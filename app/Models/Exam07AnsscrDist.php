<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam07AnsscrDist extends Model
{
    use HasFactory;

    protected $table = 'exam07_ansscr_dists';
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'myclass_id',
    //     'exam_name_id',
    //     'exam_type_id',
    //     'exam_part_id',
    //     'subject_id',
    //     'section_id',
    //     'teacher_id',
    //     'user_id',
    //     'is_active',
    //     'assigned_by',
    //     'assigned_at',
    //     'remarks',
    //     'session_id',
    //     'school_id'
    // ];

    protected $casts = [
        'is_active' => 'boolean',
        'assigned_at' => 'datetime',
    ];

    // Relationships
    public function myclass()
    {
        return $this->belongsTo(Myclass::class, 'myclass_id');
    }

    public function examName()
    {
        return $this->belongsTo(Exam01Name::class, 'exam_name_id');
    }

    public function examType()
    {
        return $this->belongsTo(Exam02Type::class, 'exam_type_id');
    }

    public function examPart()
    {
        return $this->belongsTo(Exam03Part::class, 'exam_part_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function section()
    {
        return $this->belongsTo(MyclassSection::class, 'section_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
