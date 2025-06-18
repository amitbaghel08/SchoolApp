<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'teacher_id', 'subject_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, );
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function assignment()
    {
        return $this->hasMany(Assignment::class);
    }
}
