<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// use app\Teacher;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'google_id',
        'isRequested',
        'role_id',
        'teacher_id',
        'studentdb_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
    public function teacher() {
        return $this->hasOne(Teacher::class, 'user_id', 'id');
        // 'user_id' is the foreign key of the User model
        // 'id' is the primary key of the Teacher model
    }
    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');   
        
    }

    public function studentdb(){
        return $this->belongsTo(Studentdb::class, 'studentdb_id', 'id');
        // 'studentdb_id' is the foreign key of the User model
        // 'id' is the primary key of the Studentdb model
    }
}
