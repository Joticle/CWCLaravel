<?php

namespace App\Models\Traits\CourseModule;

use App\Models\CourseModuleContent;

trait Relationships
{

    public function contents()
    {
        return $this->hasMany(CourseModuleContent::class, 'course_module_id', 'id')->orderBy('sort_order', 'asc');
    }

}
