<?php

namespace App\Models\Traits\CourseSyllabus;

trait Attributes
{
    public function getSyllabus()
    {
        return $this->getFile('file') ?:  asset('images/no-image.jpg');
    }

    public function removeSyllabus()
    {
        return $this->unlinkFile('file');
    }

    public function getFileContentPath()
    {
        return $this->getFilePath('file') ?:  public_path('images/no-image.jpg');
    }
}
