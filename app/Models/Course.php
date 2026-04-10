<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','slug','price','description','image','status'
    ];

    // 1 course - nhiều lesson
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // 1 course - nhiều enrollment
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // many to many
    public function students()
    {
        return $this->belongsToMany(Student::class,'enrollments');
    }

    // scope
    public function scopePublished($q)
    {
        return $q->where('status','published');
    }

    public function scopePriceBetween($q,$min,$max)
    {
        return $q->whereBetween('price',[$min,$max]);
    }
}