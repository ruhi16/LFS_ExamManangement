<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    


    public function user(){
        return $this->hasOne(User::class);
    }

    public function Myclassteachers(){
        return $this->hasMany(Myclassteacher::class, 'teacher_id', 'id');
        // 'teacher_id' is the foreign key in the Myclassteacher table
        // 'id' is the primary key in the Teacher table
    }


    public function Answerscriptdistributions(){
        return $this->hasMany(Answerscriptdistribution::class, 'teacher_id', 'id');
        // 'teacher_id' is the foreign key in the Answerscriptdistribution table
        // 'id' is the primary key in the Teacher table
    }


    public function subject(){
        return $this->belongsTo(Subject::class, 'main_subject_id', 'id');
        // 'subject_id' is the foreign key in the Teacher table
        // 'id' is the primary key in the Subject table
    }
}






