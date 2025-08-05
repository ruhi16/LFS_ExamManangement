<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam02Type extends Model
{
    use HasFactory;
    
    protected $table = 'exam02_types';
    protected $guarded = ['id'];
    
    public function examDetails(){
        return $this->hasMany(Exam05Detail::class, 'exam_type_id', 'id');
    }
}
