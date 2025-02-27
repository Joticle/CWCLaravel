<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\CourseEnroll\Attributes;
use App\Models\Traits\CourseEnroll\Relationships;

class CourseEnroll extends Model
{
    use Attributes, Relationships, HasFactory;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'course_enroll'; // Specify the table name if different from model name convention

    protected $fillable = [
        'course_id',
        'user_id',
        'date',
        'amount',
        'status',
        'payment_id'
    ];



    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
