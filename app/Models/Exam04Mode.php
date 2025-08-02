<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam04Mode extends Model
{
    use HasFactory;
    
    public function examDetails(){
        return $this->hasMany(Exam05Detail::class, 'exam_mode_id', 'id');
    }
}
