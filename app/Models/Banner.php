<?php

namespace App\Models;

use App\Models\Traits\Banner\Attributes;
use App\Models\Traits\Banner\Relationships;
use App\Traits\UploadFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory, UploadFiles, Attributes, Relationships;

    protected $guarded = ['id'];
}
