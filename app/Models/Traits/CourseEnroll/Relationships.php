<?php

namespace App\Models\Traits\CourseEnroll;

use App\Models\Course;

trait Relationships
{

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
