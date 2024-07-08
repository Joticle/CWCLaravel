<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Traits\Course\Attributes;
use App\Models\Traits\Course\Relationships;

class Courses extends Model
{
    use HasFactory, SoftDeletes, Attributes, Relationships;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'courses'; // Specify the table name if different from model name convention

    const LEVELS = ['Beginner' => 'Beginner', 'Intermediate' => 'Intermediate', 'Expert' => 'Expert'];
    const DEFAULT_LEVEL = 'Beginner';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_date',
        'end_date',
        'status',
        'price',
        'tags'
    ];

}
