<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CourseRequirement\Attributes;
use App\Models\Traits\CourseRequirement\Relationships;

class CourseRequirement extends Model
{
    use HasFactory, Attributes, Relationships;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'course_requirement';

    protected $guarded = ['id'];

}
