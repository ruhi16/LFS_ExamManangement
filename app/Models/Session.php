<?php

namespace App\Models;

use App\Models\School;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model{
    use HasFactory;

    protected $guarded = ['id'];
    private static $table_type = "Basic";
    




    public function school(){
        return $this->belongsTo(School::class);
    }


    
    public function myclasses(){
        return $this->hasMany(Myclass::class);
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }


    public function studentdbs(){
        return $this->hasMany(Studentdb::class, 'session_id', 'id');
    }

    public function studentcrs(){
        return $this->hasMany(Studentcr::class, 'session_id', 'id');
    }

    public function exam(){
        return $this->hasMany(Exam::class);
    }
    
    public function exammodes(){
        return $this->hasMany(Exammode::class);
    }


    public function examtypes(){
        return $this->hasMany(Examtype::class);
    }
    
    
    public function examdetails(){
        return $this->hasMany(Examdetails::class);
    }

    public function Answerscriptdistribution(){
        return $this->hasMany(Answerscriptdistribution::class, 'subject_id', 'id');
    }


    public function marksentry(){
        return $this->hasMany(Marksentry::class, 'session_id', 'id');
    }

}
