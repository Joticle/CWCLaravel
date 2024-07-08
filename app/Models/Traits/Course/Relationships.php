<?php

namespace App\Models\Traits\Course;

use App\Models\CourseEnroll;
use App\Models\CourseModules;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

trait Relationships
{
    function modules()
    {
        return $this->hasMany(CourseModules::class, 'course_id', 'id')->orderBy('sort_order', 'asc');
    }

    public function courseEnrolls()
    {
        return $this->hasMany(CourseEnroll::class, 'course_id');
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->wishlist()->where('user_id', Auth::id())->exists();
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'course_id');
    }
}
