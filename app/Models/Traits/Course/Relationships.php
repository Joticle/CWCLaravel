<?php

namespace App\Models\Traits\Course;

use App\Models\CourseEnroll;
use App\Models\CourseModule;
use App\Models\CourseRequirement;
use App\Models\CourseSyllabus;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

trait Relationships
{
    function modules()
    {
        return $this->hasMany(CourseModule::class, 'course_id', 'id')->orderBy('sort_order', 'asc');
    }

    public function courseEnrolls()
    {
        return $this->hasMany(CourseEnroll::class, 'course_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'course_id');
    }

    public function syllabuses()
    {
        return $this->hasMany(CourseSyllabus::class);
    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'course_enroll')->wherePivot('status', 'paid');
    }

    public function requirements()
    {
        return $this->hasMany(CourseRequirement::class, 'course_id', 'id')->orderBy('sort_order', 'asc');
    }
}
