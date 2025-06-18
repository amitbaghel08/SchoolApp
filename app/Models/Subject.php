<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id', 'teacher_id'];

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
