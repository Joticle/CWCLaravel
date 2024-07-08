<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\StudentFeedback\Attributes;
use App\Models\Traits\StudentFeedback\Relationships;

class StudentsFeedback extends Model
{
    use HasFactory, Attributes, Relationships;

    protected $guarded = ['id'];

    const RATINGS = ['0' => '0','1' => '1','2' => '2','3' => '3','4' => '4','5' => '5'];

}
