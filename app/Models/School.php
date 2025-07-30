<?php

namespace App\Models;

use App\Models\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // private static $table_type = "Basic";
    // ============================== start ===================================
    private static $table_type = "Basic";


    public static function getTableType()
    {
        return self::$table_type;
    }

    public function scopeExclude($query, $value = array()){
        $columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        return $query->select( array_diff( (array) $columns, (array) $value) );
    }


    protected static function boot(){

        parent::boot();

        static::addGlobalScope('session_id', function (Builder $builder) {
            $builder->where(self::getTableName() . '.session_id', Session::where('status', 'CURRENT')->first()->id);
        });
    }

    // ============================== end =====================================





    public function sessions(){
        return $this->hasMany(Session::class);
    }

    public function myclasses(){
        return $this->hasMany(Myclass::class);
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function studentdbs(){
        return $this->hasMany(Studentdb::class, 'school_id', 'id');
    }

    public function studentcrs(){
        return $this->hasMany(Studentcr::class, 'school_id', 'id');
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
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


    public function marksentries(){
        return $this->hasMany(Marksentry::class, 'school_id', 'id');        
    }
    

}
