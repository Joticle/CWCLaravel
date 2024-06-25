<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseEnroll extends Model
{
    use HasFactory;
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
}
