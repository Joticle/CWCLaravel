<?php

namespace App\Models;

use App\Models\Traits\Trust\Attributes;
use App\Models\Traits\Trust\Relationships;
use App\Traits\UploadFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trust extends Model
{
    use HasFactory, UploadFiles, Attributes, Relationships;

    protected $table = 'trusties';

    protected $guarded = ['id'];
}
