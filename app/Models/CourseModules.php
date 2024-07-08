<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CourseModule\Attributes;
use App\Models\Traits\CourseModule\Relationships;

class CourseModules extends Model
{
    use HasFactory, SoftDeletes, Attributes, Relationships;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'course_modules'; // Specify the table name if different from model name convention

    protected $fillable = [
        'course_id',
        'name',
        'slug',
        'description',
        'start_date',
        'end_date',
        'status'
    ];

}
