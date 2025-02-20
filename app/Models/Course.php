<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Traits\Course\Attributes;
use App\Models\Traits\Course\Relationships;
use App\Traits\UploadFiles;

class Course extends Model
{
    use HasFactory, SoftDeletes, Attributes, Relationships, UploadFiles;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    const LEVELS = ['Beginner' => 'Beginner', 'Intermediate' => 'Intermediate', 'Expert' => 'Expert', 'All Levels' => 'All Levels'];
    const DEFAULT_LEVEL = 'Beginner';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_date',
        'end_date',
        'status',
        'price',
        'tags',
        'logo',
        'level',
        'certificate_issued'
    ];

    public function enrollments()
    {
        return $this->hasMany(CourseEnroll::class, 'course_id', 'id');
    }


}
