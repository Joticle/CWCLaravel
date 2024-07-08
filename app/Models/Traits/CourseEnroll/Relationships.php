<?php

namespace App\Models\Traits\CourseEnroll;

use App\Models\Courses;

trait Relationships
{

    public function course()
    {
        return $this->hasOne(Courses::class, 'id', 'course_id');
    }
}
