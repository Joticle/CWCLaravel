<?php

namespace App\Models;

use App\Models\Traits\CourseSyllabus\Attributes;
use App\Models\Traits\CourseSyllabus\Relationships;
use App\Traits\UploadFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSyllabus extends Model
{
    use HasFactory, UploadFiles, Attributes, Relationships;

    protected $table = 'course_syllabus';

    protected $guarded = ['id'];
}
