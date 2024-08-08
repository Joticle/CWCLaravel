<?php

namespace App\Models\Traits\CourseSyllabus;

trait Attributes
{
    public function getSyllabus()
    {
        return $this->getFile('file') ?:  asset('images/no-image.jpg');
    }
}
